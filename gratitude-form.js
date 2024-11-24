// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function () {
    // Get form elements
    const form = document.getElementById('gratitude-form');
    const previewContent = document.querySelector('.preview-content');
    const printButton = document.getElementById('print-letter');
    const resetButton = document.querySelector('.button-reset');

    // Function to escape HTML special characters
    function sanitizeInput(input) {
        const div = document.createElement('div');
        div.innerText = input;
        return div.innerHTML;
    }

    // Function to update preview in real-time
    function updatePreview() {
        // Get all form values
        const title = sanitizeInput(form.letterTitle.value || "Letter of Gratitude");
        const themeColor = document.querySelector('input[name="letterTheme"]:checked').value || "#000000";
        const greeting = sanitizeInput(form.letterGreeting.value || "Dear");
        const recipientName = sanitizeInput(form.recipientName.value || "John");
        const relationship = sanitizeInput(form.relationshipTo.value || "best friend");
        const historyTogether = sanitizeInput(form.historyTogether.value || "Your shared history will appear here.");
        const sharedMemories = sanitizeInput(form.sharedMemories.value || "A favorite memory goes here.");
        const impact = sanitizeInput(form.impactStatement.value || "How this person has impacted you goes here.");
        const admiredQualities = sanitizeInput(form.admiredQualities.value || "Qualities you admire in this person go here.");
        const thanksFor = sanitizeInput(form.thanksFor.value || "Things you are grateful for go here.");
        const closing = sanitizeInput(form.formalClosing.value || "Sincerely");
        const signature = sanitizeInput(form.yourSignature.value || "Your Name");
        const today = new Date().toLocaleDateString();

        // Create sections HTML only if they have content
        const historySection = historyTogether ? `
            <h4 style="color: ${themeColor};">History</h4>
            <p>${historyTogether}</p>
        ` : '';

        const memoriesSection = sharedMemories ? `
            <h4 style="color: ${themeColor};">Memories</h4>
            <p>${sharedMemories}</p>
        ` : '';

        const impactSection = impact ? `
            <h4 style="color: ${themeColor};">Impact</h4>
            <p>${impact}</p>
        ` : '';

        const qualitiesSection = admiredQualities ? `
            <h4 style="color: ${themeColor};">Admiration</h4>
            <p>${admiredQualities}</p>
        ` : '';

        const gratitudeSection = thanksFor ? `
            <h4 style="color: ${themeColor};">Gratitude</h4>
            <p>${thanksFor}</p>
        ` : '';

        // Construct preview HTML
        const previewHTML = `
            <div class="letter-preview" style="
                border-top: 10px solid ${themeColor}; 
                border-bottom: 10px solid ${themeColor}; 
                padding: 20px;
                margin: 20px 0;
                background-color: white;
                overflow-wrap: break-word;
                word-wrap: break-word;
            ">
                <h1 style="color: ${themeColor}; margin-bottom: 20px;">${title}</h1>
                <h5 style="color: ${themeColor}; margin-bottom: 10px;">🗓️ ${today}</h5>
                <h5 style="color: ${themeColor}; margin-bottom: 20px;">🙏🏻 My ${relationship}</h5>
                
                <p style="margin-bottom: 20px;">${greeting} ${recipientName},</p>
                
                <p style="margin-bottom: 20px;">I am writing this letter to express my gratitude towards you. Although the words may fall short in truly capturing my intention, I will do my best to explain how much you mean to me. Also, please don't feel the need to reciprocate any of these sentiments towards me. This letter is my gift to you, and in turn, it is a gift for me to write it.</p>
                
                ${historySection}
                ${memoriesSection}
                ${impactSection}
                ${qualitiesSection}
                ${gratitudeSection}
                
                <p style="margin-top: 40px;">
                    ${closing},<br>
                    <i>${signature}</i>
                </p>
            </div>
        `;

        // Update preview content
        previewContent.innerHTML = previewHTML;
    }

    // Add event listeners to all form inputs
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('input', updatePreview);
        input.addEventListener('change', updatePreview);
    });

    // Add event listener for radio buttons specifically
    const radioButtons = form.querySelectorAll('input[type="radio"]');
    radioButtons.forEach(radio => {
        radio.addEventListener('change', updatePreview);
    });

    // Handle form reset
    resetButton.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default reset behavior
        form.reset();
        updatePreview();
    });

    // Handle print functionality
    printButton.addEventListener('click', function () {
        const printWindow = window.open('', '_blank');
        const printContent = previewContent.innerHTML;

        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Print Gratitude Letter</title>
                <style>
                    body { 
                        font-family: Arial, sans-serif;
                        margin: 40px;
                        line-height: 1.6;
                        overflow-wrap: break-word;
                        word-wrap: break-word;
                    }
                    h5 { text-align: right; }
                    h1 { text-align: center; }
                    @media print {
                        body { margin: 0; }
                    }
                </style>
            </head>
            <body>
                ${printContent}
            </body>
            </html>
        `);

        printWindow.document.close();
        printWindow.focus();

        // Print after images and resources are loaded
        printWindow.onload = function () {
            printWindow.print();
            printWindow.close();
        };
    });

    // Generate initial preview
    updatePreview();
});