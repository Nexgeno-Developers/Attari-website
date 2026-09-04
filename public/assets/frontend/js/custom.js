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
const goBack = menu1 ? menu1.querySelector(".go_back") : null;
const menuTrigger = document.querySelector(".mobile_menu_trigger");
const menuOverlay = document.querySelector(".menu_overlay");
if (menuMain && menu1) {
	menuMain.addEventListener("click", (e) => {
		if (!menu1.classList.contains("active")) {
			return
		}
		if (e.target.closest(".menu_item_has_children")) {
			const hasChildren = e.target.closest(".menu_item_has_children");
			showSubMenu(hasChildren)
		}
	});
}
if (goBack) {
	goBack.addEventListener("click", () => {
		hideSubMenu()
	});
}
if (menuTrigger) {
	menuTrigger.addEventListener("click", () => {
		toggleMenu()
	});
}
if (closeMenu) {
	closeMenu.addEventListener("click", () => {
		toggleMenu()
	});
}
if (menuOverlay) {
	menuOverlay.addEventListener("click", () => {
		toggleMenu()
	});
}

function toggleMenu() {
	if (!menu1) {
		return
	}
	menu1.classList.toggle("active");
	if (menuOverlay) {
		menuOverlay.classList.toggle("active")
	}
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
		if (menu1 && menu1.classList.contains("active")) {
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
if (query && box) {
	query.addEventListener("click", () => {
		box.classList.toggle("active")
	});
}
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
function getAccordionStickyOffset() {
	var extra = 16;
	var stickyNav = document.getElementById("vm_nav");
	if (stickyNav) {
		var rect = stickyNav.getBoundingClientRect();
		if (rect.height && rect.top < 10 && rect.bottom > 0) {
			return Math.ceil(rect.bottom) + extra;
		}
	}
	var nav = document.querySelector(".nav-sections");
	if (nav) {
		var navRect = nav.getBoundingClientRect();
		if (navRect.height && navRect.top <= 10 && navRect.bottom > 0) {
			return Math.ceil(navRect.bottom) + extra;
		}
	}
	return extra;
}

$("li.accordion1 > span").on("click", function () {
	var $item = $(this).parent();
	var $header = $(this);
	var $content = $item.children(".contentsillabus_div");
	var $group = $item.closest(".accordion--container1").find("li.accordion1");
	var duration = 300;

	if ($item.hasClass("open")) {
		$item.removeClass("open");
		$content.stop(true, true).slideUp(duration);
		return;
	}

	var $openItems = $group.filter(".open").not($item);
	var $openContents = $openItems.children(".contentsillabus_div");

	$openItems.removeClass("open");
	$item.addClass("open");

	function scrollModuleHeadingIntoView() {
		var stickyOffset = getAccordionStickyOffset();
		var headerTop = $header.offset().top - stickyOffset;
		window.scrollTo({
			top: Math.max(headerTop, 0),
			behavior: "smooth"
		});
	}

	function showOpenedModule() {
		$content.stop(true, true).slideDown(duration);
		scrollModuleHeadingIntoView();
		setTimeout(scrollModuleHeadingIntoView, duration);
	}

	if ($openContents.length) {
		$openContents.stop(true, true).slideUp(duration).promise().done(showOpenedModule);
	} else {
		showOpenedModule();
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
	loop: true,
	margin: 22,
	autoplay: true,
	autoplayTimeout: 2000,
	autoplayHoverPause: true,
	nav: true,
	dots: false,
	navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
	responsive: {
		0: {
			items: 1.1,
			 margin: 10,
		},
		768: {
			items: 2,
		},
		1200: {
			items: 3,
		},
	},
});


$(".professional_students").owlCarousel({
    loop: true,
    margin: 22,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    nav: true,
    dots: false,
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    responsive: {
        0: {
            items: 1.1,
			 margin: 10,
        },
        768: {
            items: 2,
        },
        1200: {
            items: 3,
        },
    },
});
$(".course_video_reviews, .course_text_reviews").owlCarousel({
    loop: true,
    margin: 22,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    nav: true,
    dots: false,
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    responsive: {
        0: {
            items: 1.1,
			margin: 10,
        },
        768: {
            items: 2.3,
			
        },
        1200: {
            items: 3,
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

                addedImageUrls.push(imageUrl);
            }
        });

        if (typeof callback === 'function') {
            callback();
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

function handleScroll() {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 400) {
        loadSuccessStories();
    }
}

$(document).ready(function() {
    loadSuccessStories();

    if (isMobile) {
        $('#load-more-btn').show().on('click', function() {
            loadSuccessStories();
        });
        $(window).off('scroll', handleScroll);
    } else {
        $(window).on('scroll', handleScroll);
    }
});

(function () {
    function youtubeId(url) {
        if (!url) {
            return null;
        }
        var match = String(url).match(/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/(?:embed\/)?)([A-Za-z0-9_-]{6,11})/i);
        return match ? match[1] : null;
    }

    function isImageUrl(url) {
        return /\.(jpe?g|png|gif|webp|bmp|svg)(\?|#|$)/i.test(url || '');
    }

    function ensurePopup() {
        var popup = document.getElementById('mediaPopup');
        if (popup) {
            return popup;
        }
        popup = document.createElement('div');
        popup.id = 'mediaPopup';
        popup.className = 'media_popup';
        popup.setAttribute('role', 'dialog');
        popup.setAttribute('aria-modal', 'true');
        popup.innerHTML = '<div class="media_popup_dialog"><button type="button" class="media_popup_close" aria-label="Close">&times;</button><div class="media_popup_body"></div></div>';
        document.body.appendChild(popup);
        return popup;
    }

    function closeMediaPopup() {
        var popup = document.getElementById('mediaPopup');
        if (!popup) {
            return;
        }
        popup.classList.remove('is-open');
        document.body.classList.remove('media_popup_open');
        var body = popup.querySelector('.media_popup_body');
        if (body) {
            body.innerHTML = '';
        }
        if (window.jQuery) {
            jQuery('.professional_students').trigger('refresh.owl.carousel');
        }
    }

    function openMediaPopup(url) {
        var popup = ensurePopup();
        var body = popup.querySelector('.media_popup_body');
        var videoId = youtubeId(url);
        body.innerHTML = '';
        if (videoId) {
            popup.classList.add('is-video');
            popup.classList.remove('is-image');
            body.innerHTML = '<div class="media_popup_video"><iframe src="https://www.youtube.com/embed/' + videoId + '?autoplay=1" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>';
        } else if (isImageUrl(url) || url) {
            popup.classList.add('is-image');
            popup.classList.remove('is-video');
            body.innerHTML = '<img src="' + url + '" alt="">';
        }
        popup.classList.add('is-open');
        document.body.classList.add('media_popup_open');
    }

    document.addEventListener('click', function (event) {
        var link = event.target.closest('[data-fancybox]');
        if (!link) {
            return;
        }
        var href = link.getAttribute('href');
        if (!href || href === '#') {
            return;
        }
        event.preventDefault();
        event.stopPropagation();
        openMediaPopup(href);
    }, true);

    document.addEventListener('click', function (event) {
        var popup = document.getElementById('mediaPopup');
        if (!popup || !popup.classList.contains('is-open')) {
            return;
        }
        if (event.target === popup || event.target.closest('.media_popup_close')) {
            closeMediaPopup();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeMediaPopup();
        }
    });
})();

