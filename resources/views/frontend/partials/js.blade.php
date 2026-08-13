<!--UTM params capture & append across all a tags-->
<script>
    //Appending UTM params on all anchor tag
    document.addEventListener("DOMContentLoaded", function () {
        // Function to get query string from current URL
        function getQueryString() {
            return window.location.search;
        }

        // Function to update query string in all <a> tags
        function updateQueryStringInLinks() {
            const queryString = getQueryString();

            // Get all <a> tags
            const links = document.querySelectorAll('a');

            // Iterate through all <a> tags
            links.forEach(function (link) {
                const href = link.getAttribute('href');
                // Check if href is not null and contains "attariclasses"
                if (href && href.indexOf('https') !== -1) {
                    const url = new URL(href);
                    const searchParams = new URLSearchParams(url.search);
                    const currentParams = new URLSearchParams(queryString);

                    // Determine if the current link should include the "page" parameter based on the class
                    const shouldIncludePage = link.classList.contains('a.page-link');

                    // Append current query parameters to existing ones, with special handling for "page"
                    currentParams.forEach((value, key) => {
                        if (key !== 'page' || (shouldIncludePage && !searchParams.has(key))) {
                            searchParams.set(key, value);
                        }
                    });

                    url.search = searchParams.toString();
                    link.setAttribute('href', url.toString());
                }
            });
        }

        // Call the function when the document is ready
        updateQueryStringInLinks();
    });
</script>

<!---- bootstarp  js --------->
<script src="/assets/frontend/js/bootstrap.bundle.min.js"></script>

<!---- combined  js 
<script src="/assets/frontend/js/combined.js"></script>--------->

<!--owl carousel js-->
<script src="/assets/frontend/js/owl.carousel.js"></script>


<!--moment js-->
<script defer src="/assets/frontend/js/moment.min.js"></script>

<!--jQuery Validate-->
<script src="/assets/frontend/js/jquery.validate.min.js"></script>

<!--Toast Js-->
<script defer src="/assets/frontend/js/toastr.min.js"></script>


<script src="/assets/frontend/js/owl.carousel.min.js"></script>

<script src="/assets/frontend/js/fancybox.min.js"></script>
<script src="/assets/frontend/js/lazysizes.min.js"></script>

<!--Custom Js-->
<script src="/assets/frontend/js/Init.js?1.1.0"></script>
<script src="/assets/frontend/js/custom.js?1.2.1"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

