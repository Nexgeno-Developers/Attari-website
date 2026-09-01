<div class="modal fade syllabus_modal" id="getsyllabusModal" aria-labelledby="getsyllabusModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <button type="button" class="enquiry_modal_close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
      <div class="modal-body">
        @php
            session()->forget('enquiry_id');
            session()->forget('course_name');
        @endphp
        <form id="getsyllabus" class="syllabus_form" action="{{url(route('getsyllabusonwhatsapp'))}}" method="post" enctype="multipart/form-data">
            @csrf
    <input type="hidden" name="course" value="">
    <input type="hidden" name="enquiry_id" value="">
    <p class="syllabus_form_title text-center">Get Syllabus and Fee Detail <br> on <i class="fab fa-whatsapp get_whatsapp" aria-hidden="true"></i><span>WhatsApp</span> Now</p>
            @php
                $countries_json_path = public_path('/assets/frontend/country.json');
                $countries_json = file_get_contents($countries_json_path);
                $countries = json_decode($countries_json, true);
            @endphp
            <div class="form-row row">
                <div class="form-group col-md-12 mb-2">
                    <select aria-label="countrycode" name="countrycode" id="telephone" class="form-control">
                        
                        @foreach($countries as $country)
                            @php
                                $dialcode = '+'.$country[2];
                                $name = $country[0].' +'.$country[2];
                            @endphp
                            <option value="{{ $dialcode }}" {{ $dialcode == '+91' ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group col-md-12">
                    <input id="countryphone" type="number" inputmode="numeric" class="form-control" name="countryphone" placeholder="Enter Mobile no *" pattern="[0-9]*" autocomplete="off" required />
                </div>
                
                <div class="form-group col-md-12 text-center">
                    <button class="btn btn-primary submit_button" type="submit" value="send">Get Details</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>

    $(document).ready(function() {
    //$(document).ready(function() {
    /*function initValidate3(selector) {
        //console.log(selector);
        //console.log("hellow");
        var validator = $(selector).validate({
            errorElement: "div",
            errorPlacement: function (error, element) {
                error.addClass("invalid-feedback");
                element.closest(".form-group").append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass("is-invalid");
            },
            rules: {
                countryphone: {
                    // Custom rule for validating Indian phone numbers
                    digits: true,
                    checkIndianPhoneNumber: true,
                    minlength: {
                        param: 10,
                        depends: function(element) {
                            return $('#telephone').val() === '+91';
                        }
                    }
                }
            },
            messages: {
                countryphone: {
                    digits: "Please enter a valid number",
                    checkIndianPhoneNumber: "Invalid phone number",
                    minlength: "Mobile number must be 10 digits.<br>"
                }
            }
        });

        // Add custom method for Indian phone number validation
        $.validator.addMethod("checkIndianPhoneNumber", function(value, element) {
            var countryCode = $('#telephone').val();
            //console.log(countryCode);
            var currentValue = $(element).val();

            var errorMessage = '';

            // Clear previous error messages
            validator.settings.messages.countryphone.checkIndianPhoneNumber = '';

            // Check if the mobile number is null, undefined, or empty
            if (currentValue == null || currentValue === undefined || currentValue.trim() === "") {
                errorMessage += "Mobile number cannot be empty<br>";
            }
            // Check if mobile number starts with 0
            if (currentValue.charAt(0) === '0') {
                errorMessage += 'Mobile number cannot start with "0"<br>';
            }

            // Check if mobile number starts with 0
            // if (currentValue.startsWith('0')) {
            //     errorMessage += 'Mobile number cannot start with "0"<br>';
            // }

            // Check if country code is entered
            if (countryCode === '+91' && currentValue.length > 0 && currentValue.startsWith('91')) {
                errorMessage += "Do not enter country code<br>";
            }

            // Check if mobile number is 10 digits
            if (countryCode === '+91' && currentValue.length !== 10) {
                errorMessage += "Mobile number must be 10 digits<br>";
            }

            // Display error messages if any
            if (errorMessage) {
                validator.settings.messages.countryphone.checkIndianPhoneNumber = errorMessage;
                return false;
            }

            return true;
        }, "Invalid phone number");

        // Bind keyup event listener to input elements within the specified selector
        $(selector + ' input').on('keyup', function() {
            // Validate the current input element
            validator.element(this);
        });
    }*/

    $('#telephone').select2();

    $("#telephone").on("select2:open", function(event) {
        $('input.select2-search__field').attr('placeholder', 'Search Your Country');
    });

    // Update validation rules when country code changes
    /*$('#telephone').on('change', function() {
        var countryCode = $(this).val();

        // If not Indian country code, remove minlength and maxlength attributes
        if (countryCode !== '+91') {
            //$('#countryphone').removeAttr('minlength').removeAttr('maxlength');
        } else {
            // If Indian country code, add minlength and maxlength attributes
            //$('#countryphone').attr('minlength', '10').attr('maxlength', '10');
        }
    });*/

    //initValidate3("#getsyllabus");
    
  $.validator.addMethod("customRule",function(value,element){
   var countryCode = $('#telephone').val();
   console.log(countryCode + "f1");
   var validCharacters = /^[0-9]*$/;
    
    if (!validCharacters.test(value)) {
        $.validator.messages.customRule = "Please Enter only numbers";
        return false;
    }else if(value.charAt(0) === '0' && countryCode == '+91' && value.length > 1){
        $.validator.messages.customRule = "Please enter 10 digit mobile number without leading '0'";
        return false;        
    }else if (value.charAt(0) === '0') {
        $.validator.messages.customRule = "Please enter mobile number without leading '0'";
        return false;
    }else if (countryCode == '+91' && value.length !== 10) {
        $.validator.messages.customRule = "Please enter 10 digit mobile Number";
        return false;
    }    
    
    return true;
   
});    

    document.getElementById('countryphone').addEventListener('wheel', function(event) {
        event.preventDefault();
    });
    
    // Optionally, you can also disable the arrow keys from changing the value
    document.getElementById('countryphone').addEventListener('keydown', function(event) {
        if (event.key === 'ArrowUp' || event.key === 'ArrowDown') {
            event.preventDefault();
        }
    });

    $("#getsyllabus").find('input[name="countryphone"]').on('keyup', function() {
        $(this).valid();
    });
    
    $('#telephone').on('change', function() {
        $("#getsyllabus").valid();
    });    
    
    //new
    var validator =  $("#getsyllabus").validate({
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
        rules: {
            'countryphone': {
                required: true,
                customRule: true
            }
        },   
        messages: {
    
        }         
    });    
    
//});






    // initValidate2("#getsyllabus");
    $("#getsyllabus").submit(function (e) {
        var form = $(this);
        ajaxSubmit(e, form, responseHandlerWhatsapp);
        if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            $("input, textarea").blur();
        }
    });
    
       var responseHandlerWhatsapp = function (response) {
        var form = $("form#getsyllabus");
        form[0].reset();
        $("#getsyllabusModal").modal("hide");
        
        if (response.course) {
            var pdfUrl = response.courseSyllabus; //getPDFUrl(response.course);
            var courseName = response.course; //getCourseName(response.course);
            console.log(pdfUrl);
            downloadPDF(pdfUrl, courseName);
        }
         dataLayerWEB('secondformsubmit', 'web_enquiry', 'form successfully submit');
         console.log("whatsapp form");
    };

    /*function getPDFUrl(course) {
        var baseUrl = 'https://attariclasses.in/storage/';
        

        {{--@php
            $vmware_pdf = DB::table('courses')->where('id', 5)->value('curriculum_pdf');
            $aws_pdf = DB::table('courses')->where('id', 7)->value('curriculum_pdf');
            $azure_pdf = DB::table('courses')->where('id', 8)->value('curriculum_pdf');
            $mcse_pdf = DB::table('courses')->where('id', 9)->value('curriculum_pdf');
            $ccna_pdf = DB::table('courses')->where('id', 10)->value('curriculum_pdf');
        @endphp--}}
        
        @php
            $courseIds = [5, 7, 8, 9, 10];
            $courses = DB::table('courses')->whereIn('id', $courseIds)->pluck('curriculum_pdf', 'id');
        
            $vmware_pdf = $courses[5] ?? null;
            $aws_pdf = $courses[7] ?? null;
            $azure_pdf = $courses[8] ?? null;
            $mcse_pdf = $courses[9] ?? null;
            $ccna_pdf = $courses[10] ?? null;
        @endphp         

        if (course.includes('VMware')) {
            var pdf_path = "{{ $vmware_pdf }}";
            return baseUrl + pdf_path;
        } else if (course.includes('AWS')) {
            var pdf_path = "{{ $aws_pdf }}";
            return baseUrl + pdf_path;
        } else if (course.includes('Azure')) {
            var pdf_path = "{{ $azure_pdf }}";
            return baseUrl + pdf_path;
        } else if (course.includes('MCSE')) {
            var pdf_path = "{{ $mcse_pdf }}";
            return baseUrl + pdf_path;
        } else if (course.includes('CCNA')) {
            var pdf_path = "{{ $ccna_pdf }}";
            return baseUrl + pdf_path;
        } else {
            return '';
        }
    }*/
    
    /*function getCourseName(course) {
        if (course.includes('VMware')) {
            return 'VMware';
        } else if (course.includes('AWS')) {
            return 'AWS';
        } else if (course.includes('Azure')) {
            return 'Azure';
        } else if (course.includes('MCSE')) {
            return 'MCSE';
        } else if (course.includes('CCNA')) {
            return 'CCNA';
        } else {
            return '';
        }
    }*/
    
    function downloadPDF(pdfUrl, courseName) {
        var link = document.createElement('a');
        link.href = pdfUrl;
        link.download = courseName + '-Training-Syllabus.pdf'; // Use single word as the file name
        link.click();
    }
    

});


</script>

<style>
/* Hide spinner in WebKit browsers (Chrome, Safari, Edge) */
input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Hide spinner in Firefox */
input[type=number] {
    -moz-appearance: textfield;
}
</style>
