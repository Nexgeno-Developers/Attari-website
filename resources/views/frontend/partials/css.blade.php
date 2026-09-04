
<link rel="shortcut icon" href="{{ asset('/assets/frontend/images/favicon.webp') }}">
<link rel="stylesheet" href="/assets/frontend/css/style.css?v1.9.46" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
 
<link rel="stylesheet" href="/assets/frontend/css/responsive.css?v-1.4.15" />
<link rel="stylesheet" href="/assets/frontend/css/bootstrap.min.css" /> 
<link rel="stylesheet" href="/assets/frontend/css/owl.carousel.min.css" />
<link rel="stylesheet" href="/assets/frontend/css/owl.theme.default.min.css" />
<link rel="stylesheet" href="/assets/frontend/css/toastr.min.css" /> 

<link rel="stylesheet" href="/assets/frontend/css/owl.theme.default.css" />
<link rel="stylesheet" href="/assets/frontend/css/fancybox.min.css"/>
<!--<link rel="stylesheet" href="/assets/frontend/css/robotfonts.css" >-->
<link href="https://api.fontshare.com/v2/css?f[]=satoshi@300,400,500,700,900&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<style>
.container,
.container-sm,
.container-md,
.container-lg,
.container-xl,
.container-xxl,
.header_inner {
  width: 100%;
  max-width: 1600px;
  margin-left: auto;
  margin-right: auto;
  padding-left: 70px;
  padding-right: 70px;
}
@media (max-width: 767px) {
  .container,
  .container-sm,
  .container-md,
  .container-lg,
  .container-xl,
  .container-xxl,
  .header_inner {
    padding-left: 15px;
    padding-right: 15px;
  }
}
section.vm_banner.course_hero {
  background: #1c2746  !important;
}
.course_hero_btn_primary {
  background: #f97316 !important;
  border-color: #f97316 !important;
  color: #fff !important;
}
.course_hero_btn_outline {
  background: transparent !important;
  color: #fff !important;
}
.vm_nav.course_subnav .menu-item-link.active,
.vm_nav.course_subnav nav ul li a.active {
  background: #f97316 !important;
  color: #fff !important;
  border-bottom: 0 !important;
}
.vm_nav.course_subnav nav ul li a:hover {
  color: #111 !important;
  border-bottom: 0 !important;
}
.course_features .key_boxes i {
  background: transparent !important;
  color: #f97316 !important;
}
.course_overview {
     background: linear-gradient(180deg, #f5f8fc 0%, #eef3f9 100%);
}
.course_overview_heading {
  text-align: left !important;
}
.course_projects {
      background: linear-gradient(180deg, #f5f8fc 0%, #eef3f9 100%);
}
.course_projects .owl-stage {
  display: flex;
  align-items: stretch;
}
.course_projects .owl-item {
  display: flex;
}
.course_projects .owl-item .item {
  width: 100%;
  display: flex;
}
.course_projects .projects_covered_box {
  height: auto !important;
  flex: 1 1 auto;
  border: 0 !important;
  border-radius: 20px !important;
}
.course_projects .owl-dots {
  display: none !important;
}
.course_projects .owl-nav {
  display: block !important;
}
.course_projects .owl-nav button.owl-prev,
.course_projects .owl-nav button.owl-next {
  position: absolute !important;
  top: 50%;
  width: 42px;
  height: 42px;
  border-radius: 50% !important;
  background: #fff !important;
  border: 1px solid #d1d5db !important;
  color: #4b5563 !important;
  right: auto !important;
}
.course_projects .owl-nav button.owl-prev { left: 0 !important; }
.course_projects .owl-nav button.owl-next { right: 0 !important; }
.course_certificates .owl-dots {
  display: none !important;
}
.course_certificates .owl-nav {
  display: block !important;
}
#certificate_section.course_certificates .owl-carousel .owl-item {
  border: 0 !important;
}
.course_certificates .owl-nav button.owl-prev,
.course_certificates .owl-nav button.owl-next {
  position: absolute !important;
  top: 50%;
  width: 42px;
  height: 42px;
  border-radius: 50% !important;
  background: #fff !important;
  border: 1px solid #d1d5db !important;
  color: #4b5563 !important;
  right: auto !important;
}
.course_certificates .owl-nav button.owl-prev { left: 0 !important; }
.course_certificates .owl-nav button.owl-next { right: 0 !important; }

.course_testimonials_heading,
.course_testimonials .heading_title {
  color: #0f172a !important;
}
.course_testimonials .owl-dots {
  display: none !important;
}
.course_testimonials .owl-nav {
  display: block !important;
}
.course_testimonials .owl-nav button.owl-prev,
.course_testimonials .owl-nav button.owl-next {
  position: absolute !important;
  top: 50%;
  width: 42px;
  height: 42px;
  border-radius: 50% !important;
  background: #fff !important;
  border: 1px solid #d1d5db !important;
  color: #4b5563 !important;
  right: auto !important;
}
.course_testimonials .owl-nav button.owl-prev { left: 0 !important; }
.course_testimonials .owl-nav button.owl-next { right: 0 !important; }
.course_batch_btn {
  background: #f97316 !important;
  color: #fff !important;
}
@media screen and (max-width: 767px) {
  .owl-prev,
  .owl-next,
  button.owl-prev,
  button.owl-next,
  .owl-carousel .owl-nav button.owl-prev,
  .owl-carousel .owl-nav button.owl-next {
    width: 28px !important;
    height: 28px !important;
    min-width: 28px !important;
    padding: 0 !important;
    line-height: 1 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 10px !important;
    display: none !important;
  }
  button.owl-prev i,
  button.owl-next i,
  .owl-carousel .owl-nav button i,
  .course_projects .owl-nav button i,
  .course_certificates .owl-nav button i,
  .course_testimonials .owl-nav button i {
    font-size: 10px !important;
    line-height: 1 !important;
  }
}
</style>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NB7X8KX');</script>
<!-- End Google Tag Manager -->
<!---------------- Contact Address Schema end ------------------->

<!---- combined  js 
<script src="/assets/frontend/js/combined.js"></script>--------->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
