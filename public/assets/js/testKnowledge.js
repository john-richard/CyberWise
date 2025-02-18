document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.querySelector(".btn-primary");
    
    submitButton.addEventListener("click", async function () {
        // Hide submit button and show loading button
        const submitBtn = document.getElementById("submitButton");
        const calculateBtn = document.getElementById("calculateButton");

        if (submitBtn) submitBtn.style.display = "none";
        if (calculateBtn) calculateBtn.style.display = "inline";

        const form = document.getElementById("testKnowledgeForm");
        const selectedAnswers = {};

        // Collect all selected answers
        const radioButtons = form.querySelectorAll("input[type='radio']:checked");
        radioButtons.forEach((radio) => {
            const name = radio.getAttribute("name");
            selectedAnswers[name] = radio.value;
        });

        // Validate all questions are answered
        const totalQuestions = document.querySelectorAll(".carousel-item").length;
        if (Object.keys(selectedAnswers).length < totalQuestions) {
            alert("Please answer all questions before submitting.");
            if (submitBtn) submitBtn.style.display = "inline";
            if (calculateBtn) calculateBtn.style.display = "none";
            return;
        }

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            const response = await axios.post("/api/test-knowledge", {
                answers: selectedAnswers
            }, {
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "X-Requested-With": "XMLHttpRequest",
                    "Content-Type": "application/json",
                },
            });

            if (response.data) {
                const dataResponse = response.data;
                const updatedAt = dataResponse.updated_at;
                const lastUpdatedText = getRelativeTime(updatedAt);

                const iconMap = {
                    0: "&#128534", 1: "&#128534", 2: "&#128534", 
                    3: "&#128556;", 4: "&#128556;", 5: "&#128556;", 
                    6: '<i class="bi-shield-shaded"></i>', 
                    7: '<i class="bi-shield-shaded"></i>',
                    8: "&#129497;" 
                };

                const cardMap = {
                    0: "hackerbf", 1: "hackerbf", 2: "hackerbf", 
                    3: "cyberrisk", 4: "cyberrisk", 5: "cyberrisk", 
                    6: 'cyberdefender', 7: 'cyberdefender',
                    8: "cyberwiz" 
                };
                
                // Get the correct icon based on score
                const titleIcon = iconMap[dataResponse.score] || "";

                // Get the correct card based on score
                const cardImg = cardMap[dataResponse.score] || "";
                
                // Update card content with response data
                document.getElementById("cardContent").innerHTML = `
                    <div class="card-body">
                        <h3 class="card-title">${dataResponse.title} ${titleIcon}</h3>
                        <p class="card-text">${dataResponse.description}</p>
                        <p class="card-text">
                            <small class="text-muted font-weight-bold">Score: ${dataResponse.score} out of ${dataResponse.items}</small><br>
                            <small class="text-muted">${lastUpdatedText}</small>
                        </p>
                    </div>
                    <img class="img-fluid card-img-bottom" src="/dbassets/images/slider/${cardImg}.jpg" alt="Card image cap">
                `;
                
                //alert("Your answers have been submitted successfully!");

            } else {
                alert("Submission failed. Please try again.");
                if (submitBtn) submitBtn.style.display = "inline";
                if (calculateBtn) calculateBtn.style.display = "none";
            }
        } catch (error) {
            console.error("Error submitting form:", error);
            alert("An error occurred. Please try again later.");
        } finally {
            // Hide loading button and show submit button
            if (calculateBtn) calculateBtn.style.display = "none";
        }
    });

    /**
     * Convert timestamp to a human-readable relative time (e.g., "3 mins ago")
     */
    function getRelativeTime(updatedAt) {
        const updatedDate = new Date(updatedAt.replace(" ", "T") + "Z"); // Ensure proper formatting
        const now = new Date();
        const diffInSeconds = Math.floor((now - updatedDate) / 1000);

        if (diffInSeconds < 60) return `Last updated ${diffInSeconds} sec${diffInSeconds > 1 ? "s" : ""} ago`;
        const diffInMinutes = Math.floor(diffInSeconds / 60);
        if (diffInMinutes < 60) return `Last updated ${diffInMinutes} min${diffInMinutes > 1 ? "s" : ""} ago`;
        const diffInHours = Math.floor(diffInMinutes / 60);
        if (diffInHours < 24) return `Last updated ${diffInHours} hour${diffInHours > 1 ? "s" : ""} ago`;
        const diffInDays = Math.floor(diffInHours / 24);
        return `Last updated ${diffInDays} day${diffInDays > 1 ? "s" : ""} ago`;
    }
});
