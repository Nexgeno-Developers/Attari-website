// Function to disable text selection
function disableTextSelection(event) {
	// Check if the event target is not an input field, textarea, or select element
	if (event.target.nodeName !== "INPUT" && event.target.nodeName !== "TEXTAREA" && event.target.nodeName !== "SELECT") {
		event.preventDefault(); // This prevents text selection
	}
}

// Disable text selection on page load
document.addEventListener('mousedown', disableTextSelection);


$(document).ready(function() {
	$(".content_one").slice(0, 8).show();
	$("#loadMore_one").on("click", function(e) {
		e.preventDefault();
		$(".content_one:hidden").slice(0, 8).slideDown();
		if ($(".content_one:hidden").length == 0) {
			$("#loadMore_one").text("").addClass("noContent")
		}
	})
});
$(document).ready(function() {
	$(".content_two").slice(0, 8).show();
	$("#loadMore_two").on("click", function(e) {
		e.preventDefault();
		$(".content_two:hidden").slice(0, 8).slideDown();
		if ($(".content_two:hidden").length == 0) {
			$("#loadMore_two").text("").addClass("noContent")
		}
	})
});
$(".video_testiminials").owlCarousel({
	loop: !0,
	margin: 10,
	dots: !0,
	navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>', ],
	responsive: {
		0: {
			items: 1.1,
		},
		768: {
			items: 2,
		},
		960: {
			items: 3,
		},
		1200: {
			items: 3,
		},
	},
});
$(".slider_content_dots").owlCarousel({
	loop: !0,
	margin: 10,
	dots: !0,
	navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>', ],
	responsive: {
		0: {
			items: 1.1,
		},
		768: {
			items: 2,
		},
		960: {
			items: 2,
		},
		1200: {
			items: 2,
		},
	},
});
$(".other_courses_slider").owlCarousel({
	loop: !0,
	margin: 20,
	autoplayTimeout: 2000,
	nav: !1,
	navText: ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>', ],
	responsive: {
		0: {
			items: 1.1,
		},
		768: {
			items: 4,
		},
		960: {
			items: 4,
		},
		1200: {
			items: 4,
		},
	},
});
$(document).ready(function() {
	if ($("#counter").length > 0) {
		var a = 0;
		$(window).scroll(function() {
			var oTop = $("#counter").offset().top - window.innerHeight;
			if (a === 0 && $(window).scrollTop() > oTop) {
				$(".counter-value").each(function() {
					var $this = $(this),
						countTo = $this.attr("data-count");
					$({
						countNum: $this.text(),
					}).animate({
						countNum: countTo,
					}, {
						duration: 2000,
						easing: "swing",
						step: function() {
							$this.text(Math.floor(this.countNum))
						},
						complete: function() {
							$this.text(this.countNum)
						},
					})
				});
				a = 1
			}
		})
	}
});
$(document).ready(function() {
	if ($(window).width() <= 767) {
		$(".content_loadmore").slice(3).hide();
		$("#loadMore").on("click", function(e) {
			e.preventDefault();
			$(".content_loadmore:hidden").slice(0, 3).slideDown();
			if ($(".content_loadmore:hidden").length === 0) {
				$("#loadMore").hide()
			}
		})
	}
});
const menu1 = document.querySelector(".menu");
const menuMain = document.querySelector(".manu_main");
const closeMenu = document.querySelector(".mobile_menu_close");
const goBack = menu1.querySelector(".go_back");
const menuTrigger = document.querySelector(".mobile_menu_trigger");
menuMain.addEventListener("click", (e) => {
	if (!menu1.classList.contains("active")) {
		return
	}
	if (e.target.closest(".menu_item_has_children")) {
		const hasChildren = e.target.closest(".menu_item_has_children");
		showSubMenu(hasChildren)
	}
});
goBack.addEventListener("click", () => {
	hideSubMenu()
});
menuTrigger.addEventListener("click", () => {
	toggleMenu()
});
closeMenu.addEventListener("click", () => {
	toggleMenu()
});
document.querySelector(".menu_overlay").addEventListener("click", () => {
	toggleMenu()
});

function toggleMenu() {
	menu1.classList.toggle("active");
	document.querySelector(".menu_overlay").classList.toggle("active")
}

function showSubMenu(hasChildren) {
	subMenu = hasChildren.querySelector(".sub_menu");
	subMenu.classList.add("active");
	subMenu.style.animation = "slideLeft 0.5s ease forwards";
	const menuTitle = hasChildren.querySelector("i").parentNode.childNodes[0].textContent;
	menu1.querySelector(".current_menu_title").innerHTML = menuTitle;
	menu1.querySelector(".mobile_menu_head").classList.add("active")
}

function hideSubMenu() {
	subMenu.style.animation = "slideRight 0.5s ease forwards";
	setTimeout(() => {
		subMenu.classList.remove("active")
	}, 300);
	menu1.querySelector(".current_menu_title").innerHTML = "";
	menu1.querySelector(".mobile_menu_head").classList.remove("active")
}
window.onresize = function() {
	if (this.innerWidth > 991) {
		if (menu1.classList.contains("active")) {
			toggleMenu()
		}
	}
};
const faqs = document.querySelectorAll(".faq_box");
faqs.forEach((faq) => {
	faq.addEventListener("click", () => {
		faq.classList.toggle("active")
	})
});
const query = document.querySelector(".query_heading");
const box = document.querySelector(".query_form");
query.addEventListener("click", () => {
	box.classList.toggle("active")
});
$("li.accordion span").click(function() {
	if ($(this).parent().hasClass("open")) {
		$("li.accordion").removeClass("open");
		$("li.accordion ul").slideUp()
	} else {
		$("li.accordion ul").slideUp();
		$(this).parent().children("ul").slideDown();
		$("li.accordion").removeClass("open");
		$(this).parent().addClass("open")
	}
});
$("li.accordion1 span").click(function() {
	if ($(this).parent().hasClass("open")) {
		$("li.accordion1").removeClass("open");
		$("li.accordion1 .contentsillabus_div").slideUp()
	} else {
		$("li.accordion1 .contentsillabus_div").slideUp();
		$(this).parent().children(".contentsillabus_div").slideDown();
		$("li.accordion1").removeClass("open");
		$(this).parent().addClass("open")
	}
});

$(".accordionone h3").click(function () {

    if ($(this).parent().hasClass("open")) {

        $(".accordionone").removeClass("open");
        $(".accordionone .contentsillabus_div1").slideUp();
    } else {

        $(".accordionone .contentsillabus_div1").slideUp();
        $(".accordionone").removeClass("open");

        $(this).parent().children(".contentsillabus_div1").slideDown();
        $(this).parent().addClass("open");
    }
});


window.onscroll = function() {};
var navbar = document.getElementById("vm_nav");
$(".video_testiminials").owlCarousel({
	loop: !0,
	margin: 10,
	dots: !0,
	navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>', ],
	responsive: {
		0: {
			items: 1.1,
		},
		768: {
			items: 2,
		},
		960: {
			items: 3,
		},
		1200: {
			items: 3,
		},
	},
});
$(".blog_video_testiminials").owlCarousel({
	loop: !0,
	margin: 10,
	dots: !0,
	navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>', ],
	responsive: {
		0: {
			items: 1.1,
		},
		768: {
			items: 2,
		},
		960: {
			items: 2,
		},
		1200: {
			items: 2,
		},
	},
});
$(".projects-covered").owlCarousel({
	loop: !0,
	margin: 10,
	autoplay: !0,
	autoplayTimeout: 2000,
	nav: !0,
	navText: ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>', ],
	responsive: {
		0: {
			items: 1.1,
		},
		768: {
			items: 2.1,
		},
		960: {
			items: 3,
		},
		1200: {
			items: 3,
		},
	},
});

$('[data-fancybox="gallery2"]').fancybox({
    arrows: false, // Disable left and right arrows
    afterClose: function () {
        $('.professional_students').trigger('refresh.owl.carousel'); // Refresh carousel after closing Fancybox
    },
});

$(".professional_students").owlCarousel({
    loop: true, // Set loop to false to close the loop
    margin: 10,
    autoplay: true, // You can also change !0 to true for readability
    autoplayTimeout: 5000,
    nav: true,
    navText: ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>'],
    responsive: {
        0: {
            items: 1.1,
        },
        768: {
            items: 2,
        },
        960: {
            items: 2,
        },
        1200: {
            items: 2,
        },
    },
});
$(".trending_course").owlCarousel({
	loop: !0,
	margin: 20,
	autoplayTimeout: 2000,
	nav: !1,
	navText: ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>', ],
	responsive: {
		0: {
			items: 1.1,
		},
		768: {
			items: 5,
		},
		960: {
			items: 5,
		},
		1200: {
			items: 5,
		},
	},
});
$(document).ready(function() {
	var owl = $(".owl-carousel");
	owl.owlCarousel({
		margin: 10,
		nav: !0,
		loop: !0,
		responsive: {
			0: {
				items: 1.1,
			},
			600: {
				items: 2,
			},
			1000: {
				items: 2,
			},
		},
	});
	$(".owl-prev").html('<i class="fa fa-chevron-left"></i>');
	$(".owl-next").html('<i class="fa fa-chevron-right"></i>')
});
$(document).ready(function() {
	$('[data-fancybox="gallery"]').fancybox()
});
$(".moreinfo_button").on("click", function() {
	$(".moreinfo_box").slideToggle("slow")
})



/*document.addEventListener('DOMContentLoaded', () => {
    
if(document.querySelector('.menu') && document.querySelector('.nav-sections')){
  const sectionsContainer = document.querySelector('.page-sections');
  const sections = document.querySelectorAll('.page-section');
  const nav = document.querySelector('.nav-sections');
  const menu = nav.querySelector('.menu');
  const links = nav.querySelectorAll('.menu-item-link');
  const activeLine = nav.querySelector('.active-line');
  const sectionOffset = nav.offsetHeight + 24;
  const activeClass = 'active';
  let activeIndex = 0;
  let isScrolling = true;
  let userScroll = true;

  if (!sectionsContainer || !sections.length || !nav || !menu || !links.length || !activeLine) {
    console.error('One or more elements are not found in the DOM');
    return;
  }

  const setActiveClass = () => {
    links[activeIndex].classList.add(activeClass);
  };

  const removeActiveClass = () => {
    links[activeIndex].classList.remove(activeClass);
  };

  const moveActiveLine = () => {
    const link = links[activeIndex];
    const linkX = link.getBoundingClientRect().x;
    const menuX = menu.getBoundingClientRect().x;

    activeLine.style.transform = `translateX(${(menu.scrollLeft - menuX) + linkX}px)`;
    activeLine.style.width = `${link.offsetWidth}px`;
  };

  const setMenuLeftPosition = position => {
    menu.scrollTo({
      left: position,
      behavior: 'smooth',
    });
  };

  const checkMenuOverflow = () => {
    const activeLink = links[activeIndex].getBoundingClientRect();
    const offset = 30;

    if (Math.floor(activeLink.right) > window.innerWidth) {
      setMenuLeftPosition(menu.scrollLeft + activeLink.right - window.innerWidth + offset);
    } else if (activeLink.left < 0) {
      setMenuLeftPosition(menu.scrollLeft + activeLink.left - offset);
    }
  };

  const handleActiveLinkUpdate = current => {
    removeActiveClass();
    activeIndex = current;
    checkMenuOverflow();
    setActiveClass();
    moveActiveLine();
  };

  const init = () => {
    moveActiveLine(links[0]);
    document.documentElement.style.setProperty('--section-offset', sectionOffset);
  };

  links.forEach((link, index) => link.addEventListener('click', () => {
    userScroll = false;
    handleActiveLinkUpdate(index);
  }));

  window.addEventListener("scroll", () => {
    const currentIndex = sectionsContainer.getBoundingClientRect().top < 0
      ? (sections.length - 1) - [...sections].reverse().findIndex(section => window.scrollY >= section.offsetTop - sectionOffset * 2)
      : 0;

    if (userScroll && activeIndex !== currentIndex) {
      handleActiveLinkUpdate(currentIndex);
    } else {
      window.clearTimeout(isScrolling);
      isScrolling = setTimeout(() => userScroll = true, 100);
    }
  });

  init();
}
});*/


// Back to top
var amountScrolled = 200;
var amountScrolledNav = 25;

$(window).scroll(function () {
  if ($(window).scrollTop() > amountScrolled) {
    $("button.back-to-top").addClass("show");
  } else {
    $("button.back-to-top").removeClass("show");
  }
});

$("button.back-to-top").click(function () {
  $("html, body").animate(
    {
      scrollTop: 0
    },
    800
  );
  return false;
});

let success_stories_page = 1;
let success_stories_loading = false;
let allImagesLoaded = false; // Track if all images are loaded
const isMobile = window.innerWidth <= 767;
let addedImageUrls = []; // Track added images to avoid duplicates
let newImageElements = null;

function loadSuccessStories(callback = null) {
    if (success_stories_loading || allImagesLoaded) return; // Prevent loading if already loading or all images are loaded
    success_stories_loading = true;
    $('#success_stories_loading').show();
    $('#load-more-btn').hide();

    $.get(`/load-success-stories?page=${success_stories_page}`, function(data) {
        let images = data.data;
        newImageElements = []; // Clear previously loaded new images

        // Check if there are images returned
        if (images.length === 0) {
            allImagesLoaded = true; // Set flag if no more images
            $('#load-more-btn').hide(); // Hide Load More button if no more images
            success_stories_loading = false;
            $('#success_stories_loading').hide();
            return;
        }

        images.forEach(function(image) {
            const imageUrl = `/storage/${image.image}`;

            // Only append image if it hasn't been added before
            if (!addedImageUrls.includes(imageUrl)) {
                const imgElement = `
                    <div class="col-md-4 images">
                        <a href="${imageUrl}" data-fancybox="review">
                            <img src="${imageUrl}" data-src="${imageUrl}" />
                        </a>
                    </div>
                `;
                $('#image-container').append(imgElement);

                // Add to FancyBox only if it's a new image
                newImageElements.push({
                    src: imageUrl,
                    opts: { caption: image.caption || "" }
                });

                // Track the image URL as added
                addedImageUrls.push(imageUrl);
            }
        });

        // Initialize FancyBox for newly added images
        if (typeof callback === 'function') {
            callback(); // Reinitialize FancyBox for all new images
        }

        if (data.next_page_url) {
            success_stories_page++;
        } else {
            allImagesLoaded = true; // Set flag if no next page
            $('#load-more-btn').hide(); // Hide Load More button if no more images
        }

        success_stories_loading = false;
        $('#success_stories_loading').hide();
        if (!allImagesLoaded) {
            $('#load-more-btn').show();
        }
    });
}

// Handle FancyBox logic after opening
function initFancybox() {
    $('[data-fancybox="review"]').fancybox({
        beforeShow: function(instance, current) {
            // Check if user is on the second-to-last slide
            if (current.index === instance.group.length - 1 && !success_stories_loading) {
                // Load more images and update FancyBox
                loadSuccessStories(() => {
                    // Reopen FancyBox with newly loaded images
                    $.fancybox.getInstance().addContent(newImageElements);
                });
            }
        }
    });
}

function handleScroll() {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 400) {
        loadSuccessStories(initFancybox); // Load more stories and reinitialize FancyBox
    }
}

$(document).ready(function() {
    loadSuccessStories(initFancybox);

    if (isMobile) {
        // Show Load More button for mobile and disable scroll event
        $('#load-more-btn').show().on('click', function() {
            loadSuccessStories(initFancybox);
        });
        $(window).off('scroll', handleScroll); // Disable auto-scroll for mobile
    } else {
        // Auto-scroll for larger screens
        $(window).on('scroll', handleScroll);
    }
});

