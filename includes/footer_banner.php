
<div class="quote-banner p-4 shadow-sm mb-4 d-flex align-items-center">
    <div id="quote-wrapper" class="d-flex align-items-center gap-4 w-100">
        
        <div class="flex-shrink-0">
            <img id="q-img" src="<?php echo BASE_URL; ?>assets/img/Albert-Einstein.jpg" alt="Author Image" class="quote-image">
        </div>
        
        <div>
            <div id="q-text" class="quote-text mb-2">
                “The only thing that you absolutely have to know is the location of the library.”
            </div>
            <div id="q-author" class="quote-author">
                — Albert Einstein
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Array of 5 Library Quotes with image links
        const libraryQuotes = [
            {
                text: "“The only thing that you absolutely have to know is the location of the library.”",
                author: "Albert Einstein",
                img: "<?php echo BASE_URL; ?>assets/img/Albert-Einstein.jpg"
            },
            {
                text: "“Bad libraries build collections, good libraries build services, great libraries build communities.”",
                author: "R. David Lankes",
                img: "<?php echo BASE_URL; ?>assets/img/david-lankes.png"
            },
            {
                text: "“Google can bring you back 100,000 answers, a librarian can bring you back the right one.”",
                author: "Neil Gaiman",
                img: "<?php echo BASE_URL; ?>assets/img/neil-gaiman.jpg"
            },
            {
                text: "“When in doubt, go to the library.”",
                author: "J.K. Rowling",
                img: "<?php echo BASE_URL; ?>assets/img/rowling.png"
            },
            {
                text: "“A library is not a luxury but one of the necessities of life.”",
                author: "Henry Ward Beecher",
                img: "<?php echo BASE_URL; ?>assets/img/henry-ward-beecher.jpg"
            }
        ];

        let currentIndex = 0;
        const wrapper = document.getElementById('quote-wrapper');
        const quoteText = document.getElementById('q-text');
        const quoteAuthor = document.getElementById('q-author');
        const quoteImg = document.getElementById('q-img');

        // Function to change the quote
        function changeQuote() {
            // 1. Fade out
            wrapper.style.opacity = 0;

            // 2. Wait for fade out to finish (500ms), change content, then fade back in
            setTimeout(() => {
                currentIndex = (currentIndex + 1) % libraryQuotes.length;
                
                quoteText.innerHTML = libraryQuotes[currentIndex].text;
                quoteAuthor.innerHTML = "— " + libraryQuotes[currentIndex].author;
                quoteImg.src = libraryQuotes[currentIndex].img;
                
                // Fade back in
                wrapper.style.opacity = 1;
            }, 500); // This 500ms matches the CSS transition time
        }

        // Run the function every 6000 milliseconds (6 seconds)
        setInterval(changeQuote, 6000);
    });
</script>