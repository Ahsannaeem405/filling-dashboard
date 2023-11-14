@extends('admin.layouts.master')
@section('content')
<style>
     .image-preview {
            display: inline-block;
            margin: 10px;
        }
        #Notes textarea{
outline:none;
padding:10px 15px;
    }
    #Notes .save-btn{
        outline: none;
    border-radius: 30px;
    border: none;
    padding: 13px 30px;
    background-color: #c5c2c287;
    color: #282828;
    font-weight: 600;
    width: 12rem;
    }
    #Notes .save-btn img{
        width: 18px;
    margin-right: 5px;
    vertical-align: sub;
    }
    .profile-content p{
        margin-bottom:0;
    }
    .refresh-btn-wraper{
        margin-bottom:30px;
    }
    .refresh-btn-wraper svg,
    .update-btn-wraper svg {
            margin-right: 5px;
        }
        .update-btn-wraper button, .refresh-btn-wraper button {
    outline: none;
    border-radius: 30px;
    border: none;
    padding: 13px 30px;
    background-color: #c5c2c287;
    color: #282828;
    font-weight: 600;
    width: 12rem;
}
    /*  */
    .table-wrapper table {
            border-collapse: collapse;
            width: 100%;
        }

        .table-wrapper th, td {
            padding: 8px;
            text-align: left;
        }
        .table-wrapper th:first-child,
        .table-wrapper td:first-child,
        .table-wrapper th:last-child,
        .table-wrapper td:last-child {
            width: 30%; 
        }
        .table-wrapper tr{
            border-bottom: 1px solid gray;
        }
        .table-wrapper th {
            background-color: #f2f2f2;
        }

        .table-wrapper .action-icons a {
            margin: 0 5px;
            text-decoration: none;
            background-color:#7367F0;
            color:black;
            border-radius:5px;
            padding: 6px 7px;

        }
        .table-wrapper .action-icons a img{
            width: 18px;
    vertical-align: sub;
        }
        input#fileInput {
    position: absolute;
    top: 400%;
}


.file-label{
    outline: none;
    border-radius: 30px;
    border: none;
    padding: 13px 30px;
    background-color: #c5c2c287;
    color: #282828;
    font-weight: 600;
    width: 12rem;
    cursor: pointer;
    text-align:center;
}
#previewContainer .image-preview{
    display: inline-block;
    margin: 10px;
    position: relative;
    width: 200px;
    height: 150px;
}
#previewContainer .image-preview img{
    width: 100%;
    height: 100%;
    border: 1px solid;
    border-radius: 8px;
}
#previewContainer .image-preview button{
    position: absolute;
    left: 0;
    top: 0;
    background: #656060;
    border: none;
    border-radius: 5px;
}
</style>
<section id="end-pills">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Right Alignment</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <ul class="nav nav-pills justify-content-start">
                            <li class="nav-item">
                                <a class="nav-link active" id="Chat-tab" data-toggle="pill" href="#Chat" aria-expanded="true">Chat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="MyAds-tab" data-toggle="pill" href="#MyAds" aria-expanded="false">My Ads</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="NewAd-tab" data-toggle="pill" href="#NewAd" aria-expanded="false">New Ad</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Profile-tab" data-toggle="pill" href="#Profile" aria-expanded="false">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Notes-tab" data-toggle="pill" href="#Notes" aria-expanded="false">Notes</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="Chat" aria-labelledby="Chat-tab" aria-expanded="true">
                                <p>Chat</p>
                            </div>
                            <div class="tab-pane" id="MyAds" role="tabpanel" aria-labelledby="MyAds-tab" aria-expanded="false">
                            <div class="refresh-btn-wraper" style='text-align:end'>
                                <button> <svg style='fill:white;' xmlns="http://www.w3.org/2000/svg"  height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V448c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H176c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/></svg> Refresh</button>
                                </div>
                                <div class="table-wrapper">
                                <table>
                                    <tr style='border-bottom: 2px solid gray;'>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>boss lifestyle 600</td>
                                        <td>730</td>
                                        <td>Active</td>
                                        <td class="action-icons">
                                            <a href="#"><img src="{{asset('app-assets/images/user/magnifying-plus.png')}}" alt="png" ></a>
                                            <a href="#"><img src="{{asset('app-assets/images/user/video-pause.png')}}" alt="png" ></a>
                                            <a href="#"><img style='margin-left: 2px;' src="{{asset('app-assets/images/user/delete.png')}}" alt="png" ></a>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="NewAd" role="tabpanel" aria-labelledby="NewAd-tab" aria-expanded="false">
                                <div class="content-body">
                                    <!-- Form wizard with step validation section start -->
                                    <section id="validation">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header d-block text-center">
                                                        <h2 class="card-title font-weight-bold">Upload a new Ad</h2>
                                                        <p>Fill all form field to go to next step</p>
                                                    </div>
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <form action="#" class="steps-validation wizard-circle">
                                                                <!-- Step 1 -->
                                                                <h6><i class="step-icon feather icon-home"></i> General</h6>
                                                                <fieldset>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="firstName3">
                                                                                    Ad Title
                                                                                </label>
                                                                                <input type="text" class="form-control required" id="firstName3" name="firstName" placeholder="Ad Title">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="Price">
                                                                                    Price
                                                                                </label>
                                                                                <input type="number" class="form-control required" id="Price" name="Price" placeholder="Price in €">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="Seller">
                                                                                    Seller Name
                                                                                </label>
                                                                                <input type="text" class="form-control required" id="Seller" name="Seller">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="plz">
                                                                                    PLZ
                                                                                </label>
                                                                                <input type="text" class="form-control required" id="plz" name="plz">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="location">
                                                                                    Select Category
                                                                                </label>
                                                                                <select class="custom-select form-control" id="location" name="location">
                                                                                    <option value="">New York</option>
                                                                                    <option value="Amsterdam">Chicago</option>
                                                                                    <option value="Berlin">San Francisco</option>
                                                                                    <option value="Frankfurt">Boston</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>

                                                                <!-- Step 2 -->
                                                                <h6><i class="step-icon feather icon-briefcase"></i> Requirements</h6>
                                                                <fieldset>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="art">
                                                                                    Art
                                                                                </label>
                                                                                <input type="text" class="form-control required" id="art" name="art" placeholder="Add Art...">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="Versand">
                                                                                    Versand
                                                                                </label>
                                                                                <input type="text" class="form-control required" id="Versand" name="Versand">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>

                                                                <!-- Step 3 -->
                                                                <h6><i class="step-icon feather icon-image"></i> Additional</h6>
                                                                <fieldset>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="eventName3">
                                                                                    Description
                                                                                </label>
                                                                                <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Description..."></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="content-body">
                                                                            <!-- Dropzone section start -->
                                                                            <section id="dropzone-examples">
                                                                                <!-- remove thumbnail file upload starts -->
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="card">
                                                                                            <div class="card-content">
                                                                                                <div class="card-body">
                                                                                                    <label class='file-label' for="fileInput"> Upload images </label>
                                                                                                    <input type="file" id="fileInput" multiple>
                                                                                                    <!-- <button id="uploadButton" type="button">Upload</button> -->
                                                                                                    <div id="previewContainer"></div>
                                                                                                    <div id="progress"></div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- remove thumbnail file upload ends -->
                                                                            </section>
                                                                            <!-- // Dropzone section end -->

                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Form wizard with step validation section end -->

                                </div>
                            </div>
                            <div class="tab-pane" id="Profile" role="tabpanel" aria-labelledby="Profile-tab" aria-expanded="false">
                            <div class="update-btn-wraper" style='text-align:end'>
                                <button> <svg style='fill:white;' xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V448c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H176c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/></svg>
                                    Update</button>
                                </div>
                                <div class="profile-content">
                                    <p><span style='font-weight:bold;'>Mail: </span>Tis.Han@gmx.com</p>
                                    <p><span style='font-weight:bold;'>Contact-Name: </span>Luise</p>
                                    <p><span style='font-weight:bold;'>Postal-Code: </span>88515 </p>
                                    <p><span style='font-weight:bold;'>Sustainability: </span> </p>
                                    <p><span style='font-weight:bold;'>Reply-Rate: </span> </p>
                                    <p><span style='font-weight:bold;'>Reply-Speed: </span> </p>
                                    <p><span style='font-weight:bold;'>Online-Ads: </span>1 </p>
                                    <p><span style='font-weight:bold;'>Historical-Ads: </span>1 </p>
                                    <p><span style='font-weight:bold;'>Followers: </span>0 </p>

                                </div>
                            </div>
                            <div class="tab-pane" id="Notes" role="tabpanel" aria-labelledby="Notes-tab" aria-expanded="false">
                            <textarea name="" id="textarea" style='width:100%; height:300px;' ></textarea>
                                <div class="save-btn-wraper text-center">
                                <button class='save-btn'> 
                                <img src="{{asset('app-assets/images/user/save.png')}}" alt="png" >Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        const fileInput = $('#fileInput');
        const uploadButton = $('#uploadButton');
        const previewContainer = $('#previewContainer');
        const progress = $('#progress');

        // Set limits
        const maxImages = 5; // Maximum number of images
        const maxFileSizeMB = 2; // Maximum file size in megabytes

        // Function to create a preview element for an image
        function createImagePreview(file) {
            const previewElement = $('<div>').addClass('image-preview');

            const imageElement = $('<img>').attr({
                src: URL.createObjectURL(file),
                width: 100,
                height: 100
            });

            const removeButton = $('<button>').text('Remove');
            removeButton.on('click', function() {
                // Remove the preview element when the remove button is clicked
                previewElement.remove();
            });

            previewElement.append(imageElement, removeButton);
            previewContainer.append(previewElement);
        }

        // Function to check if file size is within limits
        function isFileSizeValid(file) {
            return file.size <= maxFileSizeMB * 1024 * 1024; // Convert MB to bytes
        }

        uploadButton.on('click', function() {
            const files = fileInput[0].files;

            if (files.length === 0) {
                alert('Please select one or more files to upload.');
                return;
            }

            if (files.length > maxImages) {
                alert(`You can upload a maximum of ${maxImages} images.`);
                return;
            }

            // Check file size for each selected file
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                if (!isFileSizeValid(file)) {
                    alert(`File size of ${file.name} exceeds the maximum allowed size of ${maxFileSizeMB} MB.`);
                    return;
                }
            }

            // Simulate separate uploads for each selected file
            $.each(files, function(index, file) {
                const formData = new FormData();
                formData.append('file', file);

                // You can replace this with your server-side upload endpoint
                const uploadUrl = '/upload';

                $.ajax({
                    url: uploadUrl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function() {
                        alert('Upload successful.');
                    },
                    error: function() {
                        alert('Upload failed.');
                    }
                });
            });
        });

        // Listen for changes to the file input and create previews for selected images
        fileInput.on('change', function() {
            const files = fileInput[0].files;

            if (files.length > maxImages) {
                alert(`You can select a maximum of ${maxImages} images.`);
                return;
            }

            $.each(files, function(index, file) {
                createImagePreview(file);
            });

            // Clear the file input after selecting files
            fileInput.val('');
        });
    });
</script>
{{-- <script>
    const fileInput = document.getElementById('fileInput');
    const uploadButton = document.getElementById('uploadButton');
    const previewContainer = document.getElementById('previewContainer');
    const progress = document.getElementById('progress');

    // Function to create a preview element for an image
    function createImagePreview(file) {
        const previewElement = document.createElement('div');
        previewElement.className = 'image-preview';

        const imageElement = document.createElement('img');
        imageElement.src = URL.createObjectURL(file);
        imageElement.width = 100;
        imageElement.height = 100;

        const removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.addEventListener('click', () => {
            // Remove the preview element when the remove button is clicked
            previewElement.remove();
            // Remove the corresponding file from the file input
            fileInput.value = '';
        });

        previewElement.appendChild(imageElement);
        previewElement.appendChild(removeButton);
        previewContainer.appendChild(previewElement);
    }

    uploadButton.addEventListener('click', () => {
        const files = fileInput.files;

        if (files.length === 0) {
            alert('Please select one or more files to upload.');
            return;
        }

        // Simulate separate uploads for each selected file
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const formData = new FormData();
            formData.append('file', file);

            // You can replace this with your server-side upload endpoint
            const uploadUrl = '/upload';

            fetch(uploadUrl, {
                method: 'POST',
                body: formData,
            })
            .then(response => {
                if (response.ok) {
                    alert('Upload successful.');
                } else {
                    alert('Upload failed.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });

    // Listen for changes to the file input and create previews for selected images
    fileInput.addEventListener('change', () => {
        const files = fileInput.files;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            createImagePreview(file);
        }
    });
</script> --}}
@endsection
