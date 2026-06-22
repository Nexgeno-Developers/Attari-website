<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AuthenticateController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\FaqController;
/*
use App\Http\Controllers\backend\TestimonialController;
use App\Http\Controllers\backend\TeamController;
use App\Http\Controllers\backend\AwardController;
*/
use App\Http\Controllers\backend\BlogCategoryController;
use App\Http\Controllers\backend\BlogCommentController;
use App\Http\Controllers\backend\BlogController;
/*
use App\Http\Controllers\backend\NewsCategoryController;
use App\Http\Controllers\backend\NewsController;
use App\Http\Controllers\backend\PracticeAreaController;
*/
use App\Http\Controllers\backend\TrumbowygController;
/*
use App\Http\Controllers\backend\MediaCoverageController;
use App\Http\Controllers\backend\PublicationController;
*/
use App\Http\Controllers\backend\ContactController;

use App\Http\Controllers\backend\BusinessSettingController;

/*
use App\Http\Controllers\backend\ContactSettingController;
*/
use App\Http\Controllers\backend\AuthorController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\CompanyController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\BatchesController;
use App\Http\Controllers\backend\TextReviewController;
use App\Http\Controllers\backend\ImageReviewController;
use App\Http\Controllers\backend\VideoReviewController;
use App\Http\Controllers\backend\SyllabusController;
use App\Http\Controllers\backend\ProjectCoveredController;
use App\Http\Controllers\backend\CertificateController;

use App\Http\Controllers\backend\CmsController;
use App\Http\Controllers\backend\NewsletterController;
use App\Http\Controllers\backend\LogController;

use App\Http\Controllers\backend\LearningsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//authentication
Route::get('/', function () { return redirect(route('backend.login')); });
Route::get('/login', [AuthenticateController::class, 'index'])->name('backend.login');
Route::post('/login', [AuthenticateController::class, 'login'])->name('backend.login');
Route::get('/logout', [AuthenticateController::class, 'logout'])->name('backend.logout');

Route::get('/verify-otp', [AuthenticateController::class, 'verify_otp_form'])->name('verify-otp');
Route::post('/verify-otp', [AuthenticateController::class, 'verifyOtp'])->name('verify-otp');

Route::post('/resend-otp', [AuthenticateController::class, 'resendOtp'])->name('resend-otp');

//dashborad
Route::get('/dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');

//Testimonials
/*
Route::group(['prefix' => 'testimonial'], function () {
    Route::get('/index', [TestimonialController::class, 'index'])->name('testimonial.index');
    Route::get('/add', [TestimonialController::class, 'add'])->name('testimonial.add');
    Route::get('/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
    Route::post('/create', [TestimonialController::class, 'create'])->name('testimonial.create');
    Route::post('/update', [TestimonialController::class, 'update'])->name('testimonial.update');
    Route::post('/delete/{id}', [TestimonialController::class, 'delete'])->name('testimonial.delete');
    Route::get('/status/{id}/{status}', [TestimonialController::class, 'status'])->name('testimonial.status');
});
*/

//team
/*
Route::group(['prefix' => 'team'], function () {
    Route::get('/index', [TeamController::class, 'index'])->name('team.index');
    Route::get('/add', [TeamController::class, 'add'])->name('team.add');
    Route::get('/edit/{id}', [TeamController::class, 'edit'])->name('team.edit');
    Route::get('/view/{id}', [TeamController::class, 'view'])->name('team.view');
    Route::post('/create', [TeamController::class, 'create'])->name('team.create');
    Route::post('/update', [TeamController::class, 'update'])->name('team.update');
    Route::post('/delete/{id}', [TeamController::class, 'delete'])->name('team.delete');
    Route::get('/status/{id}/{status}', [TeamController::class, 'status'])->name('team.status');
});
*/

//Award
/*
Route::group(['prefix' => 'award'], function () {
    Route::get('/index', [AwardController::class, 'index'])->name('award.index');
    Route::get('/add', [AwardController::class, 'add'])->name('award.add');
    Route::get('/edit/{id}', [AwardController::class, 'edit'])->name('award.edit');
    Route::post('/create', [AwardController::class, 'create'])->name('award.create');
    Route::post('/update', [AwardController::class, 'update'])->name('award.update');
    Route::post('/delete/{id}', [AwardController::class, 'delete'])->name('award.delete');
    Route::get('/status/{id}/{status}', [AwardController::class, 'status'])->name('award.status');
});
*/


//blogcategory
Route::group(['prefix' => 'blogs/category'], function () {
    Route::get('/index', [BlogCategoryController::class, 'index'])->name('blogcategory.index');
    Route::get('/add', [BlogCategoryController::class, 'add'])->name('blogcategory.add');
    Route::get('/edit/{id}', [BlogCategoryController::class, 'edit'])->name('blogcategory.edit');
    Route::post('/create', [BlogCategoryController::class, 'create'])->name('blogcategory.create');
    Route::post('/update', [BlogCategoryController::class, 'update'])->name('blogcategory.update');
    Route::post('/delete/{id}', [BlogCategoryController::class, 'delete'])->name('blogcategory.delete');
    Route::get('/status/{id}/{status}', [BlogCategoryController::class, 'status'])->name('blogcategory.status');
});

//blogcomments
Route::group(['prefix' => 'blogs/comment'], function () {
    Route::get('/index', [BlogCommentController::class, 'index'])->name('blogcomment.index');
    Route::post('/delete/{id}', [BlogCommentController::class, 'delete'])->name('blogcomment.delete');
    Route::get('/status/{id}/{status}', [BlogCommentController::class, 'status'])->name('blogcomment.status');
});

//blogs
Route::group(['prefix' => 'blogs'], function () {
    Route::get('/index', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/add', [BlogController::class, 'add'])->name('blogs.add');
    Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::get('/view/{id}', [BlogController::class, 'view'])->name('blogs.view');
    Route::post('/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/update', [BlogController::class, 'update'])->name('blogs.update');
    Route::post('/delete/{id}', [BlogController::class, 'delete'])->name('blogs.delete');
    Route::get('/status/{id}/{status}', [BlogController::class, 'status'])->name('blogs.status');
});


//Newscategory
/*
Route::group(['prefix' => 'news/category'], function () {
    Route::get('/index', [NewsCategoryController::class, 'index'])->name('newscategory.index');
    Route::get('/add', [NewsCategoryController::class, 'add'])->name('newscategory.add');
    Route::get('/edit/{id}', [NewsCategoryController::class, 'edit'])->name('newscategory.edit');
    Route::post('/create', [NewsCategoryController::class, 'create'])->name('newscategory.create');
    Route::post('/update', [NewsCategoryController::class, 'update'])->name('newscategory.update');
    Route::post('/delete/{id}', [NewsCategoryController::class, 'delete'])->name('newscategory.delete');
    Route::get('/status/{id}/{status}', [NewsCategoryController::class, 'status'])->name('newscategory.status');
});
*/

//News
/*
Route::group(['prefix' => 'news'], function () {
    Route::get('/index', [NewsController::class, 'index'])->name('news.index');
    Route::get('/add', [NewsController::class, 'add'])->name('news.add');
    Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
    Route::get('/view/{id}', [NewsController::class, 'view'])->name('news.view');
    Route::post('/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/update', [NewsController::class, 'update'])->name('news.update');
    Route::post('/delete/{id}', [NewsController::class, 'delete'])->name('news.delete');
    Route::get('/status/{id}/{status}', [NewsController::class, 'status'])->name('news.status');
});
*/

//PracticeArea
/*
Route::group(['prefix' => 'practicearea'], function () {
    Route::get('/index', [PracticeAreaController::class, 'index'])->name('practicearea.index');
    Route::get('/add', [PracticeAreaController::class, 'add'])->name('practicearea.add');
    Route::get('/edit/{id}', [PracticeAreaController::class, 'edit'])->name('practicearea.edit');
    Route::get('/view/{id}', [PracticeAreaController::class, 'view'])->name('practicearea.view');
    Route::post('/create', [PracticeAreaController::class, 'create'])->name('practicearea.create');
    Route::post('/update', [PracticeAreaController::class, 'update'])->name('practicearea.update');
    Route::post('/delete/{id}', [PracticeAreaController::class, 'delete'])->name('practicearea.delete');
    Route::get('/status/{id}/{status}', [PracticeAreaController::class, 'status'])->name('practicearea.status');
});
*/

//News
Route::group(['prefix' => 'trumbowyg'], function () {
    Route::post('/upload', [TrumbowygController::class, 'upload'])->name('trumbowyg.upload');
});

//mediacoverage
/*
Route::group(['prefix' => 'mediacoverage'], function () {
    Route::get('/index', [MediaCoverageController::class, 'index'])->name('mediacoverage.index');
    Route::get('/add', [MediaCoverageController::class, 'add'])->name('mediacoverage.add');
    Route::get('/edit/{id}', [MediaCoverageController::class, 'edit'])->name('mediacoverage.edit');
    Route::post('/create', [MediaCoverageController::class, 'create'])->name('mediacoverage.create');
    Route::post('/update', [MediaCoverageController::class, 'update'])->name('mediacoverage.update');
    Route::post('/delete/{id}', [MediaCoverageController::class, 'delete'])->name('mediacoverage.delete');
    Route::get('/status/{id}/{status}', [MediaCoverageController::class, 'status'])->name('mediacoverage.status');
});
*/

//Publication
/*
Route::group(['prefix' => 'publication'], function () {
    Route::get('/index', [PublicationController::class, 'index'])->name('publication.index');
    Route::get('/add', [PublicationController::class, 'add'])->name('publication.add');
    Route::get('/edit/{id}', [PublicationController::class, 'edit'])->name('publication.edit');
    Route::post('/create', [PublicationController::class, 'create'])->name('publication.create');
    Route::post('/update', [PublicationController::class, 'update'])->name('publication.update');
    Route::post('/delete/{id}', [PublicationController::class, 'delete'])->name('publication.delete');
    Route::get('/status/{id}/{status}', [PublicationController::class, 'status'])->name('publication.status');
});

*/

//Contact
Route::group(['prefix' => 'contact'], function () {
    Route::get('/index', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/view/{id}', [ContactController::class, 'view'])->name('contact.view');
    Route::post('/delete/{id}', [ContactController::class, 'delete'])->name('contact.delete');
});


//newsletter
Route::group(['prefix' => 'newsletter'], function () {
    Route::get('/index', [NewsletterController::class, 'index'])->name('newsletter.index');
    Route::post('/delete/{id}', [NewsletterController::class, 'delete'])->name('newsletter.delete');
});


//setting
Route::group(['prefix' => 'setting'], function () {
    Route::get('/index', [BusinessSettingController::class, 'index'])->name('setting.index');
    
    Route::get('/privacy-policy', [BusinessSettingController::class, 'privacy_policy'])->name('setting.privacy');
    Route::get('/terms', [BusinessSettingController::class, 'terms'])->name('setting.terms');
    Route::get('/refund-policy', [BusinessSettingController::class, 'refund_policy'])->name('setting.refund_policy');

    Route::post('/update', [BusinessSettingController::class, 'update'])->name('setting.update');
});

Route::group(['prefix' => 'website-setting'], function () {
    Route::get('/wati-templet', [BusinessSettingController::class, 'wati_templet'])->name('website_setting.wati_templet');
    Route::post('/wati-templet/update', [BusinessSettingController::class, 'update_wati_templet'])->name('website_setting.wati_templet.update');
    Route::get('/email-templet', [BusinessSettingController::class, 'email_templet'])->name('website_setting.email_templet');
    Route::post('/email-templet/generate', [BusinessSettingController::class, 'generate_email_templet'])->name('website_setting.email_templet.generate');
});


//Contact Page setting
Route::group(['prefix' => 'contact/page'], function () {
    Route::get('/index', [ContactSettingController::class, 'index'])->name('contactpage.index');
    Route::post('/update', [ContactSettingController::class, 'update'])->name('contactpage.update');
});

//clear cache
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');

    // Redirect back to the previous page
    return back()->with('status', 'Cache cleared successfully!');
})->name('clear-cache');


//Author
Route::group(['prefix' => 'author'], function () {
    Route::get('/index', [AuthorController::class, 'index'])->name('author.index');
    Route::get('/add', [AuthorController::class, 'add'])->name('author.add');
    Route::get('/edit/{id}', [AuthorController::class, 'edit'])->name('author.edit');
    Route::post('/create', [AuthorController::class, 'create'])->name('author.create');
    Route::post('/update', [AuthorController::class, 'update'])->name('author.update');
    Route::post('/delete/{id}', [AuthorController::class, 'delete'])->name('author.delete');
    //Route::get('/status/{id}/{status}', [AuthorController::class, 'status'])->name('author.status');
});

//User
Route::group(['prefix' => 'profile'], function () {
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/reset/{id}', [UserController::class, 'password'])->name('user.password');
    Route::post('/update', [UserController::class, 'update'])->name('user.update');
    Route::post('/reset', [UserController::class, 'reset'])->name('user.reset');    
});

//company
Route::group(['prefix' => 'company'], function () {
    Route::get('/index', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/add', [CompanyController::class, 'create'])->name('company.add');
    Route::post('/store', [CompanyController::class, 'store'])->name('company.store');
    Route::get('/edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
    Route::post('/update/{id}', [CompanyController::class, 'update'])->name('company.update');
    Route::post('/delete/{id}', [CompanyController::class, 'destroy'])->name('company.delete');
    Route::get('/save-policies-form', [CompanyController::class, 'savepoliciesForm'])->name('company.savepoliciesForm');
    Route::any('/save-policies', [CompanyController::class, 'savepoliciesPost'])->name('company.savepoliciesPost');
});

//course
Route::group(['prefix' => 'course'], function () {
    Route::get('/index', [CourseController::class, 'index'])->name('course.index');
    Route::get('/add', [CourseController::class, 'add'])->name('course.add');

    Route::get('/edit/{id}/{section}', [CourseController::class, 'edit'])->name('course.edit');
    Route::get('/view/{id}', [CourseController::class, 'view'])->name('course.view');
    Route::post('/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/update', [CourseController::class, 'update'])->name('course.update');
    Route::post('/update/heading', [CourseController::class, 'update_heading'])->name('course.update_heading');
    Route::post('/delete/{id}', [CourseController::class, 'delete'])->name('course.delete');
    Route::get('/status/{id}/{status}', [CourseController::class, 'status'])->name('course.status');

    Route::post('/update/schema', [CourseController::class, 'update_schema'])->name('course.update_schema');
    
    Route::post('/update/seo', [CourseController::class, 'seo_update'])->name('course.seo_update');
});

//Batch
Route::group(['prefix' => 'batch'], function () {
    Route::post('/create', [BatchesController::class, 'create'])->name('batch.create');
    Route::post('/update', [BatchesController::class, 'update'])->name('batch.update');
});

//Text Reviews
Route::group(['prefix' => 'textreviews'], function () {
    Route::get('/edit/{id}', [TextReviewController::class, 'edit'])->name('text.edit');
    Route::post('/create', [TextReviewController::class, 'create'])->name('text.create');
    Route::post('/update', [TextReviewController::class, 'update'])->name('text.update');
    Route::post('/delete/{id}', [TextReviewController::class, 'delete'])->name('text.delete');
    Route::get('/status/{id}/{status}', [TextReviewController::class, 'status'])->name('text.status');
});

//Text Reviews
Route::group(['prefix' => 'imagesreviews'], function () {
    Route::get('/', [ImageReviewController::class, 'index'])->name('images.index');
    Route::get('/edit/{id}', [ImageReviewController::class, 'edit'])->name('images.edit');
    Route::post('/create', [ImageReviewController::class, 'create'])->name('images.create');
    Route::post('/update', [ImageReviewController::class, 'update'])->name('images.update');
    Route::post('/delete/{id}', [ImageReviewController::class, 'delete'])->name('images.delete');
    Route::get('/status/{id}/{status}', [ImageReviewController::class, 'status'])->name('images.status');
});

//Text Reviews
Route::group(['prefix' => 'videoreviews'], function () {
    Route::get('/edit/{id}', [VideoReviewController::class, 'edit'])->name('videos.edit');
    Route::post('/create', [VideoReviewController::class, 'create'])->name('videos.create');
    Route::post('/update', [VideoReviewController::class, 'update'])->name('videos.update');
    Route::post('/delete/{id}', [VideoReviewController::class, 'delete'])->name('videos.delete');
    Route::get('/status/{id}/{status}', [VideoReviewController::class, 'status'])->name('videos.status');
});

//faq
Route::group(['prefix' => 'faq'], function () {
    Route::get('/course/{course}/list', [FaqController::class, 'list'])->name('faq.list');
    Route::get('/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit');
    Route::post('/create', [FaqController::class, 'create'])->name('faq.create');
    Route::post('/update', [FaqController::class, 'update'])->name('faq.update');
    Route::post('/delete/{id}', [FaqController::class, 'delete'])->name('faq.delete');
    Route::get('/status/{id}/{status}', [FaqController::class, 'status'])->name('faq.status');
});

//syllabus 
Route::group(['prefix' => 'syllabus'], function () {
    Route::get('/edit/{id}', [SyllabusController::class, 'edit'])->name('syllabus.edit');
    Route::post('/create', [SyllabusController::class, 'create'])->name('syllabus.create');
    Route::post('/update', [SyllabusController::class, 'update'])->name('syllabus.update');
    Route::post('/delete/{id}', [SyllabusController::class, 'delete'])->name('syllabus.delete');
    Route::get('/status/{id}/{status}', [SyllabusController::class, 'status'])->name('syllabus.status');
    Route::get('/pdf-preview/{courseId}', [SyllabusController::class, 'generate_curriculum_pdf'])->name('syllabus.pdf');
});

//project_covered
Route::group(['prefix' => 'projectcovered'], function () {
    Route::get('/edit/{id}', [ProjectCoveredController::class, 'edit'])->name('project_covered.edit');
    Route::post('/create', [ProjectCoveredController::class, 'create'])->name('project_covered.create');
    Route::post('/update', [ProjectCoveredController::class, 'update'])->name('project_covered.update');
    Route::post('/delete/{id}', [ProjectCoveredController::class, 'delete'])->name('project_covered.delete');
    Route::get('/status/{id}/{status}', [ProjectCoveredController::class, 'status'])->name('project_covered.status');
});


//certificate
Route::group(['prefix' => 'certificate'], function () {
    Route::get('/edit/{id}', [CertificateController::class, 'edit'])->name('certificate.edit');
    Route::post('/create', [CertificateController::class, 'create'])->name('certificate.create');
    Route::post('/update', [CertificateController::class, 'update'])->name('certificate.update');
    Route::post('/delete/{id}', [CertificateController::class, 'delete'])->name('certificate.delete');
    Route::get('/status/{id}/{status}', [CertificateController::class, 'status'])->name('certificate.status');
});

//cms
Route::group(['prefix' => 'cms'], function () {
    Route::get('/index', [CmsController::class, 'index'])->name('cms.index');
    Route::get('/add', [CmsController::class, 'add'])->name('cms.add');
    Route::get('/edit/{id}', [CmsController::class, 'edit'])->name('cms.edit');

    Route::get('cms-data', [CmsController::class, 'getData'])->name('cms.data');


    Route::post('/create', [CmsController::class, 'create'])->name('cms.create');
    Route::post('/update', [CmsController::class, 'update'])->name('cms.update');
    Route::post('/delete/{id}', [CmsController::class, 'delete'])->name('cms.delete');
    Route::get('/status/{id}/{status}', [CmsController::class, 'status'])->name('cms.status');
});

//logs
Route::group(['prefix' => 'logs'], function () {
    Route::get('/index', [LogController::class, 'index'])->name('log.index');
});

//learnings
Route::group(['prefix' => 'learning'], function () {
    Route::post('/create', [LearningsController::class, 'create'])->name('learning.create');
    Route::post('/update', [LearningsController::class, 'update'])->name('learning.update');
});
