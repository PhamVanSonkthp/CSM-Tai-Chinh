const quaInterest = 0.01;
let totalMoney = 0;
let totalMonth = 0;

const inputLoan = document.querySelector(".tabs-register__input>input");
if (inputLoan) {
    inputLoan.addEventListener("input", function () {
        inputLoan.value = new Intl.NumberFormat("vn").format(inputLoan.value);

        // const inputLoan = document.querySelector(".tabs-register__input>input");
        const itemMonth = document.querySelector(".tabs-register__item>p.active");
        countInterest(itemMonth);

        handleGetDetails(itemMonth.dataset.value);

    });

    inputLoan.addEventListener("blur", function () {
        if (inputLoan.value.replaceAll(',', "").replaceAll('.', '') < 30000000) {
            inputLoan.value = new Intl.NumberFormat("vn").format(30000000);

            const itemMonth = document.querySelector(".tabs-register__item>p.active");
            countInterest(itemMonth);
            handleGetDetails(itemMonth.dataset.value);
        }

        if (inputLoan.value.replaceAll(',', "").replaceAll('.', '') > 200000000) {
            inputLoan.value = new Intl.NumberFormat("vn").format(200000000);

            const itemMonth = document.querySelector(".tabs-register__item>p.active");
            countInterest(itemMonth);
            handleGetDetails(itemMonth.dataset.value);
        }


    });
}

const btnContinue = document.querySelector(".tabs-register__btn");
if (btnContinue) {
    btnContinue.addEventListener("click", () => {
        if (btnContinue.disabled == false) {
            $(".tabs-register__alert-confirm").css("display", "block");
        }
    });
}

const btnCancelForm = document.querySelector(".btn-cancel");
if (btnCancelForm) {
    btnCancelForm.addEventListener("click", () => {
        $(".tabs-register__alert-confirm").css("display", "none");
    });
}

const btnConfirmForm = document.querySelector(".btn-confirm");
if (btnConfirmForm) {
    btnConfirmForm.addEventListener("click", () => {

        $('.label_loan').html(new Intl.NumberFormat("vn").format(
            totalMoney
        ))
        $('.label_loan_month').html(totalMonth)
        $('#interval').val(totalMonth)

        $('#infoConfirm').offcanvas('show')
    });
}

// Show Toast Click Unverified identity
const clickAccLink = document.querySelectorAll(".tabs-account__link.active, .tab-register");
const toastLive = document.getElementById("liveToast");

// if (clickAccLink) {
//   clickAccLink.forEach((ItemAccLink) => {
//     ItemAccLink.addEventListener("click", () => {
//       const toast = new bootstrap.Toast(toastLive);
//
//       toast.show();
//     });
//   });
// }

// Handle btn eye show money
const btnEyeList = document.querySelectorAll(".surplus-header__icon");
if (btnEyeList) {
    btnEyeList.forEach((btnItemEye, index) => {
        btnItemEye.addEventListener("click", () => {
            const checkEye = btnItemEye.closest(".surplus-header__wrapper").classList;
            checkEye.value.includes("active")
                ? checkEye.remove("active")
                : checkEye.add("active");

            if (index == 0) {
                $(".surplus-details__money.fist").css("display", "none");
                $(".surplus-details__money.last").css("display", "block");
            } else {
                $(".surplus-details__money.fist").css("display", "block");
                $(".surplus-details__money.last").css("display", "none");
            }
        });
    });
}

// Handle Click Month
const listMonth = document.querySelectorAll(".tabs-register__item>p");
if (listMonth) {
    listMonth.forEach((itemMonth) => {
        itemMonth.addEventListener("click", function () {
            $(".tabs-register__item>p.active").removeClass("active");
            itemMonth.classList.add("active");

            countInterest(itemMonth);

            //   console.log();
            handleGetDetails(itemMonth.dataset.value);
        });
    });
}

// Calculate Interest Money
function countInterest(itemMonth) {
    const valueInput = parseInt(inputLoan.value.replaceAll(',', "").replaceAll('.', ''));
    const valueMonth = parseInt(itemMonth.dataset.value);

    console.log(valueInput)
    console.log(valueMonth)

    if (inputLoan.value !== "") {
        $(".tabs-register__btn").prop("disabled", false);

        const numInterMonth = valueInput * quaInterest * valueMonth;
        const numInterest = document.querySelector(".batMoney");
        const resultMoney = (valueInput + numInterMonth) / valueMonth;


        numInterest.textContent = new Intl.NumberFormat("vn").format(
            resultMoney.toFixed()
        );
    } else {
        $(".tabs-register__btn").prop("disabled", true);
    }

    const moneyAlert = document.querySelector(".alert-form__money");
    const monthAlert = document.querySelector(".alert-form__month");
    if (monthAlert) {
        totalMonth = valueMonth;
        monthAlert.textContent = valueMonth;
    }

    if (moneyAlert) {
        totalMoney = valueInput.toFixed();
        moneyAlert.textContent = new Intl.NumberFormat("vn").format(
            valueInput.toFixed()
        );
    }
}

// Handle Get Table Details
function handleGetDetails(numMonth) {
    const newDate = new Date();
    let [month, day] = [newDate.getMonth(), newDate.getDate()];
    month+= 1;

    $(".tabs-details tbody").text("");

    for (let i = 0; i < numMonth; i++) {
        const priceValue = handleMoneyTenor(parseInt(numMonth), parseInt(i));

        const templateDetails =
            /* html */
            `<tr class="ant-table-row ant-table-row-level-0">
            <td class="">
                <span class="ant-typography">
                    Kì thứ ${i + 1}
                </span>
            </td>
            <td class="">
                <span class="ant-typography">
                    <strong>${priceValue}</strong>
                </span>
            </td>
            <td class="">
                <span class="ant-typography">
                    <strong>
                        ${day} - ${++month % 12 == 0 ? 12 : month % 12}
                    </strong>
                </span>
            </td>
        </tr>`;

        $(".tabs-details tbody").append(templateDetails);
    }
}

function handleMoneyTenor(numMonth, indexTenor) {
    const inputLoan = document.querySelector(".tabs-register__input>input"); // 30.000.000
    const valueInput = parseInt(inputLoan.value.replaceAll(',', "").replaceAll('.', '')); // 30000000
    //   if(isNaN(valueInput)) {};
    if (isNaN(valueInput)) return 0;

    if (indexTenor == 0) {
        const numInterMonth = parseInt(valueInput) * quaInterest * numMonth;
        const resultMoney = (parseInt(valueInput) + numInterMonth) / numMonth;

        const MoneyMonthFirst = new Intl.NumberFormat("vn").format(
            resultMoney.toFixed()
        );
        return MoneyMonthFirst;
        // console.log(MoneyMonthFirst, "Tháng đầu");
    } else {
        const numMonthly = valueInput / numMonth;
        const moneyMothNext = valueInput - numMonthly * indexTenor;
        const numInterestTenor =
            (moneyMothNext * (quaInterest * numMonth)) / numMonth;

        const totalFinal = numMonthly + numInterestTenor;

        // console.log(totalFinal, `Tháng ${indexTenor}`);
        return new Intl.NumberFormat("vn").format(totalFinal.toFixed());
    }
}
