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
<script src="<?php echo base_url(); ?>assets/plugins/custom/jquery-md5/jquery.md5.js"></script>
<div class="card shadow-sm">
    <div class="card-header bg-success">
        <h3 class="card-title text-white"><?php echo $title; ?></h3>
        <!-- <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-bg-white btn-icon me-2 mb-2" onclick="return KTDataTables.init();">
            <i class="las la-sync fs-1"></i>
            </button>
        </div> -->
    </div>
    <div class="card-body py-10">
        <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <!--begin::Form-->
            <form class="form w-100" novalidate="novalidate" id="kt_password_reset_form" action="<?php echo site_url('master/do_change'); ?>">
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <?php //echo $this->session->userdata('kode_vendor');?>
                    <!--end::Title-->
                    <!--begin::Link-->
                    <!-- <div class="text-gray-400 fw-bold fs-4">Enter your email to reset your password.</div> -->
                    <!--end::Link-->
                </div>
                <!--begin::Heading-->
                <!--begin::Input group-->
                <div class="fv-row mb-0">
                    <label class="form-label fw-bolder text-gray-900 fs-6">Password Lama</label>
                    <input class="form-control" type="password" placeholder="Masukkan Password Lama" id="current_password" name="current_password" autocomplete="off" />
                    <span toggle="#current_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <!-- <div class="fv-row mb-10">
                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                        <input class="form-check-input" type="checkbox" onclick="showPassword('current')"/>
                        <label class="form-check-label fw-bold text-gray-700 fs-6" for="flexRadioLg">
                        Tampilkan Password
                        </label>
                    </div>
                </div> -->
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-0">
                    <label class="form-label fw-bolder text-gray-900 fs-6">Password Baru</label>
                    <input class="form-control" type="password" placeholder="Masukkan Password Baru" id="new_password" name="new_password" autocomplete="off" />
                    <span toggle="#new_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <!-- <div class="fv-row mb-10">
                    <div class="form-check form-check-custom form-check-solid form-check-sm">
                        <input class="form-check-input" type="checkbox" onclick="showPassword('new')"/>
                        <label class="form-check-label fw-bold text-gray-700 fs-6" for="flexRadioLg">
                        Tampilkan Password
                        </label>
                    </div>
                </div> -->
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-0">
                    <label class="form-label fw-bolder text-gray-900 fs-6">Konfirmasi Password Baru</label>
                    <input class="form-control" type="password" placeholder="Konfirmasi Password Baru" id="confirm_password" name="confirm_password" autocomplete="off" />
                    <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <!--end::Input group-->
                <div class="fv-row mb-10">
                    <!-- <div class="form-check form-check-custom form-check-solid form-check-sm">
                        <input class="form-check-input" type="checkbox" value="" id="flexRadioLg" onclick="showPassword('confirm')"/>
                        <label class="form-check-label fw-bold text-gray-700 fs-6" for="flexRadioLg">
                        Tampilkan Password
                        </label>
                    </div> -->
                </div>
                <!--begin::Actions-->
                <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                    <button type="button" id="kt_password_reset_submit" class="btn btn-lg btn-success fw-bolder me-4">
                        <span class="indicator-label">Ubah Password</span>
                        <span class="indicator-progress">Silahkan tunggu...
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
    </div>
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
                        current_password: { 
                            validators: { 
                                notEmpty: { 
                                    message: "Password Lama tidak boleh kosong" 
                                } 
                            } 
                        },
                        new_password: { 
                            validators: { 
                                notEmpty: { 
                                    message: "Password Baru tidak boleh kosong" 
                                } 
                            } 
                        },
                        confirm_password: {
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
                                d.current_password = $.md5(d.current_password),
                                d.new_password = $.md5(d.new_password),
                                d.confirm_password = $.md5(d.confirm_password),
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
                                                t.isConfirmed && (document.location = '<?php echo site_url('master/change_password'); ?>');
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
                                                        t.isConfirmed && (t.dismiss);
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
                }),
                c.addEventListener("click", function (n) {
                    f.reset();
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

    function showPassword(name) {
        var x = document.getElementById(name + "_password");
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