<!-- BEGIN: Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->
<script src="{{ asset('app-assets/js/scripts/pages/app-chat.js') }}"></script>
<!-- BEGIN: Theme JS-->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('app-assets/js/core/app.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/components.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/dropzone.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/ui/prism.min.js') }}"></script>
<!-- END: Theme JS-->
<script src="{{ asset('app-assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<!-- BEGIN: Page JS-->
<script src="{{ asset('app-assets/js/scripts/pages/app-chat.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/forms/wizard-steps.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/extensions/dropzone.js') }}"></script>
<!-- END: Page JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/tether.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/shepherd.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
<style>
    .custom-success-toast {
        background-color: #4CAF50;
        color: #ffffff;
    }

    .custom-warning-toast {
        background-color: rgb(163, 23, 23);
        color: #ffffff;
    }
</style>
@if (session('toast_error'))
    <script>
        var errors = {!! json_encode(session('toast_error')) !!};
        for (var i = 0; i < errors.length; i++) {
            toastr.error(errors[i], 'Validation Error');
        }
    </script>
@endif

<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}", '', {
            toastClass: 'custom-success-toast'
        });
    @endif
    @if (Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
    @endif
    @if (Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
    @endif
    @if (Session::has('message'))
        toastr.success("{{ Session::get('success') }}");
    @endif
    @if (Session::has('error'))
        toastr.error("{{ Session::get('error') }}", '', {
            toastClass: 'custom-warning-toast'
        });
    @endif
</script>

<script>
    function deleteUser(userId) {
        Swal.fire({
            title: 'Delete User',
            text: 'Are you sure you want to delete this user?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms the deletion, submit the form
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }

    function deleteAccount(accountId) {
        Swal.fire({
            title: 'Delete Account',
            text: 'Are you sure you want to delete this account?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms the deletion, submit the form
                document.getElementById('delete-form-' + accountId).submit();
            }
        });
    }
</script>

<script>
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));

        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
<script>
    function showImagePreview() {
        const imageInput = document.getElementById('profile_image');
        const currentImage = document.getElementById('image-preview');


        if (imageInput.files && imageInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                currentImage.src = e.target.result;
                imageNameDisplay.textContent = imageInput.files[0].name;
            };

            reader.readAsDataURL(imageInput.files[0]);
        }
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
<script>
    $('#iconLeft4-1').emojioneArea({
        pickerPosition: 'top'
    });
</script>