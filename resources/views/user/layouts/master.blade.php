<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    @yield('title')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ optional(\App\Models\Logo::first())->image_path }}">


    <link rel="stylesheet" href="{{asset('assets/user/assets/css/fontawesome.css')}}"/>
    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{asset('assets/user/assets/css/swiper-bundle.min.css')}}">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="{{asset('assets/user/assets/css/bootstrap.min.css')}}">

    <!-- Style Css -->
    <link rel="stylesheet" href="{{asset('assets/user/assets/css/style.css')}}">
    <!-- Responsive Css -->
    <!-- <link rel="stylesheet" href="./assets/css/responsive.css"> -->

    @yield('css')

</head>

<body>

@include('user.components.header')
@yield('content')
@include('user.components.footer')

<script src="{{asset('assets/user/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/user/assets/js/bootstrap.bundle.min.js')}}"></script>

<!-- Swiper JS -->
<script type="text/javascript" src="{{asset('vendor/swiper/swiper-bundle.min.js')}}"></script>
<!-- Script Slide Banner -->
<script>
    // ==================== Slide Banner Image ================
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 10,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        // Navigation arrows
        // navigation: {
        //     nextEl: '.swiper-button-next',
        //     prevEl: '.swiper-button-prev',
        // },
        direction: 'horizontal',
        autoplay: {
            delay: 3000,
        },
    });
</script>
<script type="text/javascript" src="{{asset('assets/user/assets/js/main.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://rawgithub.com/RobinHerbots/jquery.inputmask/2.x/dist/jquery.inputmask.bundle.js"></script>
<!-- Select Js -->
<script src="{{asset('assets/user/assets/js/selectBs.js')}}"></script>
<!-- Sign Js -->
<script src="{{asset('assets/user/assets/js/signature.js')}}"></script>
<script>
    // ================ Signature ================
    const wrapper = document.getElementById("signature-pad");
    const clearButton = wrapper.querySelector("[data-action=clear]");
    const changeColorButton = wrapper.querySelector("[data-action=change-color]");
    const undoButton = wrapper.querySelector("[data-action=undo]");
    const savePNGButton = document.querySelector("[data-action=save-png]");
    const saveJPGButton = wrapper.querySelector("[data-action=save-jpg]");
    const saveSVGButton = wrapper.querySelector("[data-action=save-svg]");
    const canvas = wrapper.querySelector("canvas");
    const signaturePad = new SignaturePad(canvas, {
        // It's Necessary to use an opaque color when saving image as JPEG;
        // this option can be omitted if only saving as PNG or SVG
        backgroundColor: 'rgb(255, 255, 255)'
    });


    function resizeCanvas() {
        // When zoomed out to less than 100%, for some very strange reason,
        // some browsers report devicePixelRatio as less than 1
        // and only part of the canvas is cleared then.
        const ratio = Math.max(window.devicePixelRatio || 1, 1);

        // This part causes the canvas to be cleared
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);

        // This library does not listen for canvas changes, so after the canvas is automatically
        // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
        // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
        // that the state of this library is consistent with visual state of the canvas, you
        // have to clear it manually.
        signaturePad.clear();
    }


    window.onresize = resizeCanvas;
    resizeCanvas();

    function download(dataURL, filename) {
        const blob = dataURLToBlob(dataURL);
        const url = window.URL.createObjectURL(blob);

        const a = document.createElement("a");
        a.style = "display: none";
        a.href = url;
        a.download = filename;

        document.body.appendChild(a);
        a.click();

        window.URL.revokeObjectURL(url);
    }

    function dataURLToBlob(dataURL) {
        // Code taken from https://github.com/ebidel/filer.js
        const parts = dataURL.split(';base64,');
        const contentType = parts[0].split(":")[1];
        const raw = window.atob(parts[1]);
        const rawLength = raw.length;
        const uInt8Array = new Uint8Array(rawLength);

        for (let i = 0; i < rawLength; ++i) {
            uInt8Array[i] = raw.charCodeAt(i);
        }

        return new Blob([uInt8Array], {
            type: contentType
        });
    }

    clearButton.addEventListener("click", () => {
        signaturePad.clear();
    });


    savePNGButton.addEventListener("click", () => {
        if (signaturePad.isEmpty()) {
            alert("Vui lòng Ký tên!");
        } else {
            const dataURL = signaturePad.toDataURL();
            const signatureImg = document.querySelector(".info-signature__img");
            signatureImg.src = dataURL;
            $('#sign_image_path').val(dataURL)
            // download(dataURL, "signature.png");

            $("#signature-pad").css("display", "none");
            $(".info-contract__btn").css("display", "none");
            $(".info-contract__btn-create").css("display", "block");
        }
    });
</script>

<script>
    //====================  HANDLE Up File Image ====================
    window.addEventListener("load", function () {
        const inputFileList = document.querySelectorAll('input[type="file"]');
        inputFileList.forEach((inputFileItem) => {
            inputFileItem.addEventListener("click", () => {
                inputFileItem.value = null;
            });

            inputFileItem.addEventListener("change", function () {
                if (this.files && this.files[0]) {
                    var imgPosition = inputFileItem
                        .closest(".info-front__img");

                    imgPosition.onload = () => {
                        URL.revokeObjectURL(imgPosition.style
                            .backgroundImage); // no longer needed, free memory
                    };

                    const linkFile = URL.createObjectURL(this.files[0]);
                    imgPosition.style
                        .backgroundImage = `url('${linkFile}')`;

                    checkValue();
                }
            });

        });

        // isCheckImage
        const checkValue = () => {
            let flagCheck = true;
            for (inputFileItem of inputFileList) {
                if (inputFileItem.value == "") {
                    flagCheck = false;
                    $('.info-front__btn').prop('disabled', true);
                }
            }
            if (flagCheck == true) {
                $('.info-front__btn').prop('disabled', false);
            }
        }
    });


    const btnContinue1 = document.querySelector(".info-front__btn");
    btnContinue1.addEventListener("click", () => {
        $('#offcanvasInfo').offcanvas('show');

    })

    // Button Information Continue
    const btnInfo = document.querySelector(".info-offcanvas__btn");
    if (btnInfo) {
        btnInfo.addEventListener("click", () => {

            if(!$('#name').val()) return
            if(!$('#identity_card_number').val()) return
            if(!$('#date_of_birth').val()) return
            if(!$('#purpose').val()) return
            if(!$('#name_friend').val()) return
            if(!$('#phone_friend').val()) return
            if(!$('#work').val()) return
            if(!$('#address').val()) return

            $('#offcanvasBank').offcanvas('show');
        })

    }

    // Button Bank
    const btnInfoBank = document.querySelector(".info-bank__btn");
    if (btnInfoBank) {
        btnInfoBank.addEventListener("click", (e) => {
            // if(!$('#bank_name').val()) return
            // if(!$('#bank_number').val()) return
            // e.preventDefault();
            // $('#infoConfirm').offcanvas('show');
        })

    }

    // Button Done
    const btnDone = document.querySelector(".info-done__btn");
    if (btnDone) {
        btnDone.addEventListener("click", (e) => {
            e.preventDefault();
            $('#offcanvasDone').offcanvas('show');
        })

    }

    // Button Sign Contract
    const btnSign = document.querySelector(".info-contract__btn");
    if (btnSign) {
        btnSign.addEventListener("click", () => {
            console.log("Ối dồi ôi");
        })
    }

    getInfo('.bankNumber', '.CardNumber', "•••••••••");
    getInfo('.bankName', '.NameNumber', "*********");


    function getInfo(inputValue, inputText, characters) {

        const numberBank = document.querySelector(inputValue);
        const textCard = document.querySelector(inputText);
        if (numberBank) {
            numberBank.addEventListener("input", () => {
                console.log(numberBank.value.length);
                console.log(numberBank.value.length > 0);
                if (numberBank.value.length > 0) {
                    textCard.textContent = numberBank.value;
                    textCard.classList.add("text")
                } else {
                    textCard.textContent = characters;
                    textCard.classList.remove("text")
                }
            })
        }
    }


    // Input Birthday
    $('.date').inputmask("dd/mm/yyyy", {
        "placeholder": "__/__/____",
        onincomplete: function () {
            $(this).val('');
        }
    });
</script>

@yield('js')

</body>

</html>
