<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_password_forgot_form" action="<?php echo site_url('login/do_forgot'); ?>">
        <!--begin::Heading-->
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">Lupa Password ?</h1>
            <!--end::Title-->
            <!--begin::Link-->
            <div class="text-gray-400 fw-bold fs-4">Silahkan masukkan email Anda untuk mereset password.</div>
            <!--end::Link-->
        </div>
        <!--begin::Heading-->
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <label class="form-label fw-bolder text-gray-900 fs-6">Username</label>
            <input class="form-control" type="text" placeholder="Masukkan Username" name="vendor_code" autocomplete="off" />
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <label class="form-label fw-bolder text-gray-900 fs-6">Email</label>
            <input class="form-control" type="email" placeholder="Masukkan Email" name="email" autocomplete="off" />
        </div>
        <!--end::Input group-->
        <!--begin::Actions-->
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="submit" id="kt_password_forgot_submit" class="btn btn-lg btn-success fw-bolder me-4">
                <span class="indicator-label">Kirim</span>
                <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <a href="<?php echo site_url('login');?>" class="btn btn-lg btn-light-danger fw-bolder">Kembali</a>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
<script type="text/javascript">
    "use strict";
    var KTResetPassword = (function() {
        var f, s, c,v;
        return {
            init: function() {
                (f = document.querySelector("#kt_password_forgot_form")),
                (s = document.querySelector("#kt_password_forgot_submit")),
                (c = document.querySelector("#kt_password_forgot_cancel")),
                (v = FormValidation.formValidation(f, {
                    fields: {
                        vendor_code: { 
                            validators: { 
                                notEmpty: { 
                                    message: "Kode Vendor tidak boleh kosong" 
                                }
                            } 
                        },
                        email: { 
                            validators: { 
                                notEmpty: { 
                                    message: "Email tidak boleh kosong" 
                                },
                                emailAddress: { 
                                    message: "Email yang Anda masukkan tidak valid" 
                                }
                            } 
                        },
                    },
                    plugins: { 
                        trigger: new FormValidation.plugins.Trigger(), 
                        bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row" }) 
                    },
                })),
                f.addEventListener("submit", function (n) {
                    n.preventDefault(),
                    v.validate().then(function (i) {
                        "Valid" == i
                            ? 
                            (
                                s.setAttribute("data-kt-indicator", "on"),
                                (s.disabled = !0),
                                $.ajax({
                                    type: "POST",
                                    url: f.getAttribute('action'),
                                    data: Object.fromEntries(new FormData(f).entries()),
                                    success: function(response) {
                                        var obj = jQuery.parseJSON(response);
                                        s.removeAttribute("data-kt-indicator"),
                                        (s.disabled = !1),
                                        Swal.fire({ 
                                            text: obj.msg, 
                                            icon: obj.status, buttonsStyling: !1, 
                                            confirmButtonText: "Ok",
                                            allowOutsideClick: false,
                                            customClass: { confirmButton: "btn btn-primary" } })
                                        .then(function (t) {
                                            t.isConfirmed && (v.resetForm(true));
                                        });
                                    }
                                })
                            )
                            : Swal.fire({
                                    text: "Silahkan isi field yang masih kosong.",
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
    });
</script>