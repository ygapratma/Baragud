<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_password_reset_form" action="<?php echo site_url('login/do_reset'); ?>">
        <!--begin::Heading-->
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">Reset Password</h1>
            <?php //echo $this->session->userdata('kode_vendor');?>
            <!--end::Title-->
            <!--begin::Link-->
            <!-- <div class="text-gray-400 fw-bold fs-4">Enter your email to reset your password.</div> -->
            <!--end::Link-->
        </div>
        <!--begin::Heading-->
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!-- <label class="form-label fw-bolder text-gray-900 fs-6">Email</label> -->
            <input class="form-control" type="password" placeholder="Masukkan Password Baru" id="new_password" name="new_password" autocomplete="off" />
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!-- <label class="form-label fw-bolder text-gray-900 fs-6">Email</label> -->
            <input class="form-control" type="password" placeholder="Konfirmasi Password Baru" id="confirm_password" name="confirm_password" autocomplete="off" />
        </div>
        <!--end::Input group-->
        <!--begin::Actions-->
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="button" id="kt_password_reset_submit" class="btn btn-lg btn-success fw-bolder me-4">
                <span class="indicator-label">Setuju</span>
                <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!-- <a href="<?php //echo site_url('login');?>" class="btn btn-lg btn-light-danger fw-bolder">Cancel</a> -->
            <button type="button" id="kt_password_reset_cancel" class="btn btn-lg btn-light-danger fw-bolder">
                <span class="indicator-label">Kembali</span>
                <!-- <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span> -->
            </button>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
<script type="text/javascript">
    "use strict";
    var KTResetPassword = (function() {
        var f, s, c,v, d;
        d = {};
        return {
            init: function() {
                (f = document.querySelector("#kt_password_reset_form")),
                (s = document.querySelector("#kt_password_reset_submit")),
                (c = document.querySelector("#kt_password_reset_cancel")),
                (v = FormValidation.formValidation(f, {
                    fields: {
                        new_password: { 
                            validators: { 
                                notEmpty: { 
                                    message: "Password Baru tidak boleh kosong" 
                                } 
                            } 
                        },
                        "confirm_password": {
                            validators: {
                                notEmpty: { message: "Konfirmasi Password tidak boleh kosong" },
                                identical: {
                                    compare: function () {
                                        return f.querySelector('[name="new_password"]').value;
                                    },
                                    message: "Password Baru dan Konfirmasi Password tidak sama",
                                },
                            },
                        },
                    },
                    plugins: { 
                        trigger: new FormValidation.plugins.Trigger(), 
                        bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row" }) 
                    },
                })),
                s.addEventListener("click", function (n) {
                    n.preventDefault(),
                    v.validate().then(function (i) {
                        "Valid" == i
                            ? 
                            (
                                s.setAttribute("data-kt-indicator", "on"),
                                (s.disabled = !0),
                                d = Object.fromEntries(new FormData(f).entries()),
                                d.vendor_id = "<?php echo $this->session->userdata('kode_vendor');?>",
                                $.ajax({
                                    type: "POST",
                                    url: f.getAttribute('action'),
                                    data: d,
                                    success: function(response) {
                                        var obj = jQuery.parseJSON(response);
                                        // console.log(obj);
                                        if(obj.code == 0) {
                                            s.removeAttribute("data-kt-indicator"),
                                            (s.disabled = !1),
                                            Swal.fire({ 
                                                text: obj.msg, 
                                                icon: "success", buttonsStyling: !1, 
                                                confirmButtonText: "Ok",
                                                allowOutsideClick: false,
                                                customClass: { confirmButton: "btn btn-primary" } })
                                            .then(function (t) {
                                                t.isConfirmed && (document.location = '<?php echo site_url('login'); ?>');
                                            });
                                        } else {
                                            setTimeout(function () {
                                                s.removeAttribute("data-kt-indicator"),
                                                    (s.disabled = !1),
                                                    Swal.fire({ 
                                                        text: obj.msg, 
                                                        icon: "error", buttonsStyling: !1, 
                                                        confirmButtonText: "Ok",
                                                        allowOutsideClick: false,
                                                        customClass: { confirmButton: "btn btn-primary" } })
                                                    .then(function (t) {
                                                        t.isConfirmed && ((f.querySelector('[name="new_password"]').value = ""), (f.querySelector('[name="confirm_password"]').value = ""));
                                                    });
                                            }, 2e3)
                                        }
                                    }
                                })
                            )
                            : Swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: { confirmButton: "btn btn-primary" },
                                });
                    });
                });
            }
        };
    })();

    KTUtil.onDOMContentLoaded(function () {
        KTResetPassword.init();
        $(window).on('beforeunload', function(){
            console.log('Ok');
        });
    });
</script>