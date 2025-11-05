<style>
.field-icon {
  float: right;
  margin-left: -25px;
  margin-right: 40px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}
</style>
<div class="w-lg-500px bg-body rounded shadow-sm py-6 px-10 mx-auto">
    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="<?php echo site_url('login/do_login'); ?>">
        <!--begin::Heading-->
        <div class="text-center mb-2">
            <!--begin::Title-->
            <h1 class="text-dark mb-1">Sistem Baragud</h1>
            <!--end::Title-->
            <!--begin::Link-->
            <div class="text-gray-400 fw-bold fs-4">Proses Pengadaan Barang yang Cepat, Akurat, & Terbuka
                <!-- <a href="../../demo1/dist/authentication/flows/basic/sign-up.html" class="link-primary fw-bolder">Create an Account</a> -->
            </div>
            <!--end::Link-->
        </div>
        <!--begin::Heading-->
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="form-label fs-6 fw-bolder text-dark">Username</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input class="form-control form-control-lg form-control-solid" type="text" name="username" id="username" autocomplete="off" />
            <!--end::Input-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-4">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack mb-2">
                <!--begin::Label-->
                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                <!--end::Label-->
                <!--begin::Link-->
                <a href="<?php echo site_url('login/forgot'); ?>" class="link-danger fs-6 fw-bolder">Lupa Password ?</a>
                <!--end::Link-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Input-->
            <!-- <input class="form-control form-control-lg form-control-solid" type="password" name="password" id="password" autocomplete="off" /> -->
            <input class="form-control form-control-lg form-control-solid" type="password" name="password" id="password"/>
            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            <!--end::Input-->
        </div>
        <!--end::Input group-->
        <div class="fv-row mb-10">
            <!-- <div class="form-check form-check-custom form-check-solid form-check-sm">
                <input class="form-check-input" type="checkbox" value="" id="flexRadioLg" onclick="showPassword()"/>
                <label class="form-check-label fw-bold text-gray-700 fs-6" for="flexRadioLg">
                Tampilkan Password
                </label>
            </div> -->
        </div>
        <!--begin::Actions-->
        <div class="text-center">
            <!--begin::Submit button-->
            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-success w-100 mb-5">
                <span class="indicator-label">Lanjutkan</span>
                <span class="indicator-progress">Silahkan tunggu...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!--end::Submit button-->
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
<script type="text/javascript">
    "use strict";
    var KTSigninGeneral = (function () {
        var t, e, i, d;
        return {
            init: function () {
                (t = document.querySelector("#kt_sign_in_form")),
                (e = document.querySelector("#kt_sign_in_submit")),
                (i = FormValidation.formValidation(t, {
                    fields: {
                        username: { validators: { notEmpty: { message: "Username is required" } } },
                        password: { 
                            validators: { 
                                notEmpty: { 
                                    message: "The password is required" 
                                } 
                            } 
                        },
                    },
                        plugins: { 
                            trigger: new FormValidation.plugins.Trigger(), 
                            bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row" }) 
                        },
                })),
                e.addEventListener("click", function (n) {
                    n.preventDefault(),
                    i.validate().then(function (i) {
                        "Valid" == i
                            ? (
                                e.setAttribute("data-kt-indicator", "on"),
                                (e.disabled = !0),
                                d = Object.fromEntries(new FormData(t).entries()),
                                d.password = $.md5(d.password),
                                // console.log(d)
                                $.ajax({
                                    type: "POST",
                                    url: t.getAttribute('action'),
                                    data: d,
                                    success: function(response) {
                                        var obj = jQuery.parseJSON(response);
                                        // console.log(obj);
                                        if(obj.code == 0) {
                                            document.location = obj.data;
                                        } else {
                                            e.removeAttribute("data-kt-indicator"),
                                            (e.disabled = !1),
                                            Swal.fire({ 
                                                text: obj.msg, 
                                                icon: "error", buttonsStyling: !1, 
                                                confirmButtonText: "Ok",
                                                allowOutsideClick: false,
                                                customClass: { confirmButton: "btn btn-primary" } })
                                            .then(function (t) {
                                                t.isConfirmed && ((e.querySelector('[name="username"]').value = ""), (e.querySelector('[name="password"]').value = ""));
                                            });
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
            },
        };
    })();

    KTUtil.onDOMContentLoaded(function () {
        KTSigninGeneral.init();
    });

    function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

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