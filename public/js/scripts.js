// Empty JS for your own code to be here
$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}


// Image Upload

$(document).ready(function() {
    $.uploadPreview({
        input_field: "#image-upload", // Default: .image-upload
        preview_box: "#image-preview", // Default: .image-preview
        label_field: "#image-label", // Default: .image-label
        label_default: "Choose File", // Default: Choose File
        label_selected: "Change File", // Default: Change File
        no_label: false // Default: false
    });
});

// KYC Upload
$(document).ready(function() {
    $.uploadPreview({
        input_field: "#kyc-image-upload-1", // Default: .image-upload
        preview_box: "#kyc-image-preview-1", // Default: .image-preview
        label_field: "#kyc-image-label-1", // Default: .image-label
        label_default: "Image Upload", // Default: Choose File
        label_selected: "Change File", // Default: Change File
        no_label: false // Default: false
    });
});

$(document).ready(function() {
    $.uploadPreview({
        input_field: "#kyc-image-upload-2", // Default: .image-upload
        preview_box: "#kyc-image-preview-2", // Default: .image-preview
        label_field: "#kyc-image-label-2", // Default: .image-label
        label_default: "Image Upload", // Default: Choose File
        label_selected: "Change File", // Default: Change File
        no_label: false // Default: false
    });
});