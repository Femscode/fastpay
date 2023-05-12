<template>
  <div class="col-md-12">
    <!--begin::Card-->
    <div class="card card-custom">
      <!--begin::Header-->
      <div class="card-header py-3">
        <div class="d-flex align-items-center">
          <div
            class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center"
          >
            <div
              class="symbol-label"
              style="
                background-image: url('../../../../../theme/html/demo2/dist/assets/media/users/300_21.jpg');
              "
            ></div>
            <i class="symbol-badge bg-success"></i>
          </div>
          <div>
            <a
              href="#"
              class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary"
              >Wallet Balance</a
            >

            <div class="mt-2">
              NGN
              <span style="font-size: 20px">{{ this.user.balance }}</span
              >.00
            </div>
          </div>
        </div>

        <div class="card-toolbar">
          <button onclick="history.back() " class="btn btn-secondary">Back</button>
        </div>
      </div>
      <!--end::Header-->
      <!--begin::Form-->
      <form class="form" @submit.prevent="buyElectricity()">
        <div class="card-body">
          <!--begin::Heading-->

          <div class="row">
            <label class="col-xl-3"></label>
            <div class="col-lg-9 col-xl-6">
              <h5 class="font-weight-bold mb-6">Pay Light Bills</h5>
            </div>
          </div>
          <!--begin::Form Group-->
          <div class="form-group row m-2">
            <h6 class="col-md-3">Service Type</h6>
            <div class="col-md-6">
              <select v-model="service_type" required class="form-control">
                <option value="01">Eko Electricity - EKEDC(PHCN)</option>
                <option value="02">Ikeja Electricity - IKEDC(PHCN)</option>
                <option value="03">PortHarcourt Electricity - PHEDC</option>
                <option value="04">Kaduna Electricity - KAEDC</option>
                <option value="05">Abuja Electricity - AEDC</option>
                <option value="06">Ibadan Electricity - IBEDC</option>
                <option value="07">Kano Electricity - KEDC</option>
                <option value="08">Jos Electricity - JEDC</option>
                <option value="09">Enugu Electricity - EEDC</option>
                <option value="10">Benin Electricity - BEDC</option>
              </select>
            </div>
          </div>
          <div class="form-group row m-2">
            <h6 class="col-md-3">Meter Type</h6>
            <div class="col-md-6">
              <select v-model="meter_type" class="form-control" required="">
                <option value="">-- Select Meter Type --</option>
                <option value="01">Prepaid</option>
                <option value="02">Postpaid</option>
              </select>
            </div>
          </div>
          <div class="form-group row m-2">
            <h6 class="col-md-3">Meter Number</h6>
            <div class="col-md-6">
              <input
                class="form-control"
                type="number"
                min="1000"
                v-model="meter_number"
              />
            </div>
          </div>
          <div v-if="show_details" class="form-group row m-2">
            <h6 class="col-md-3">Meter Details</h6>
            <div class="col-md-6">
              <div class="flex align-items-center bg-light-info rounded p-5">
                <!--begin::Icon-->
                <span class="svg-icon svg-icon-info mr-5">
                  <span class="svg-icon svg-icon-lg">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/General/Attachment2.svg-->
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                      width="24px"
                      height="24px"
                      viewBox="0 0 24 24"
                      version="1.1"
                    >
                      <g
                        stroke="none"
                        stroke-width="1"
                        fill="none"
                        fill-rule="evenodd"
                      >
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path
                          d="M11.7573593,15.2426407 L8.75735931,15.2426407 C8.20507456,15.2426407 7.75735931,15.6903559 7.75735931,16.2426407 C7.75735931,16.7949254 8.20507456,17.2426407 8.75735931,17.2426407 L11.7573593,17.2426407 L11.7573593,18.2426407 C11.7573593,19.3472102 10.8619288,20.2426407 9.75735931,20.2426407 L5.75735931,20.2426407 C4.65278981,20.2426407 3.75735931,19.3472102 3.75735931,18.2426407 L3.75735931,14.2426407 C3.75735931,13.1380712 4.65278981,12.2426407 5.75735931,12.2426407 L9.75735931,12.2426407 C10.8619288,12.2426407 11.7573593,13.1380712 11.7573593,14.2426407 L11.7573593,15.2426407 Z"
                          fill="#000000"
                          opacity="0.3"
                          transform="translate(7.757359, 16.242641) rotate(-45.000000) translate(-7.757359, -16.242641)"
                        ></path>
                        <path
                          d="M12.2426407,8.75735931 L15.2426407,8.75735931 C15.7949254,8.75735931 16.2426407,8.30964406 16.2426407,7.75735931 C16.2426407,7.20507456 15.7949254,6.75735931 15.2426407,6.75735931 L12.2426407,6.75735931 L12.2426407,5.75735931 C12.2426407,4.65278981 13.1380712,3.75735931 14.2426407,3.75735931 L18.2426407,3.75735931 C19.3472102,3.75735931 20.2426407,4.65278981 20.2426407,5.75735931 L20.2426407,9.75735931 C20.2426407,10.8619288 19.3472102,11.7573593 18.2426407,11.7573593 L14.2426407,11.7573593 C13.1380712,11.7573593 12.2426407,10.8619288 12.2426407,9.75735931 L12.2426407,8.75735931 Z"
                          fill="#000000"
                          transform="translate(16.242641, 7.757359) rotate(-45.000000) translate(-16.242641, -7.757359)"
                        ></path>
                        <path
                          d="M5.89339828,3.42893219 C6.44568303,3.42893219 6.89339828,3.87664744 6.89339828,4.42893219 L6.89339828,6.42893219 C6.89339828,6.98121694 6.44568303,7.42893219 5.89339828,7.42893219 C5.34111353,7.42893219 4.89339828,6.98121694 4.89339828,6.42893219 L4.89339828,4.42893219 C4.89339828,3.87664744 5.34111353,3.42893219 5.89339828,3.42893219 Z M11.4289322,5.13603897 C11.8194565,5.52656326 11.8194565,6.15972824 11.4289322,6.55025253 L10.0147186,7.96446609 C9.62419433,8.35499039 8.99102936,8.35499039 8.60050506,7.96446609 C8.20998077,7.5739418 8.20998077,6.94077682 8.60050506,6.55025253 L10.0147186,5.13603897 C10.4052429,4.74551468 11.0384079,4.74551468 11.4289322,5.13603897 Z M0.600505063,5.13603897 C0.991029355,4.74551468 1.62419433,4.74551468 2.01471863,5.13603897 L3.42893219,6.55025253 C3.81945648,6.94077682 3.81945648,7.5739418 3.42893219,7.96446609 C3.0384079,8.35499039 2.40524292,8.35499039 2.01471863,7.96446609 L0.600505063,6.55025253 C0.209980772,6.15972824 0.209980772,5.52656326 0.600505063,5.13603897 Z"
                          fill="#000000"
                          opacity="0.3"
                          transform="translate(6.014719, 5.843146) rotate(-45.000000) translate(-6.014719, -5.843146)"
                        ></path>
                        <path
                          d="M17.9142136,15.4497475 C18.4664983,15.4497475 18.9142136,15.8974627 18.9142136,16.4497475 L18.9142136,18.4497475 C18.9142136,19.0020322 18.4664983,19.4497475 17.9142136,19.4497475 C17.3619288,19.4497475 16.9142136,19.0020322 16.9142136,18.4497475 L16.9142136,16.4497475 C16.9142136,15.8974627 17.3619288,15.4497475 17.9142136,15.4497475 Z M23.4497475,17.1568542 C23.8402718,17.5473785 23.8402718,18.1805435 23.4497475,18.5710678 L22.0355339,19.9852814 C21.6450096,20.3758057 21.0118446,20.3758057 20.6213203,19.9852814 C20.2307961,19.5947571 20.2307961,18.9615921 20.6213203,18.5710678 L22.0355339,17.1568542 C22.4260582,16.76633 23.0592232,16.76633 23.4497475,17.1568542 Z M12.6213203,17.1568542 C13.0118446,16.76633 13.6450096,16.76633 14.0355339,17.1568542 L15.4497475,18.5710678 C15.8402718,18.9615921 15.8402718,19.5947571 15.4497475,19.9852814 C15.0592232,20.3758057 14.4260582,20.3758057 14.0355339,19.9852814 L12.6213203,18.5710678 C12.2307961,18.1805435 12.2307961,17.5473785 12.6213203,17.1568542 Z"
                          fill="#000000"
                          opacity="0.3"
                          transform="translate(18.035534, 17.863961) scale(1, -1) rotate(45.000000) translate(-18.035534, -17.863961)"
                        ></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                </span>
                <!--end::Icon-->
                <!--begin::Title-->
                <div class="d-flex flex-column flex-grow-1 mr-2">
                  <span class="text-info font-weight-bold">Customer Name</span>
                  <a
                    href="#"
                    class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1"
                  >
                    {{ customer_name }}</a
                  >
                </div>
                <div class="d-flex flex-column flex-grow-1 mr-2">
                  <span class="text-info font-weight-bold"
                    >Customer Address</span
                  >
                  <a
                    href="#"
                    class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1"
                  >
                    {{ customer_address }}
                  </a>
                </div>
                <div class="d-flex flex-column flex-grow-1 mr-2">
                  <span class="text-info font-weight-bold"
                    >Arrears Payment</span
                  >
                  <a
                    href="#"
                    class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1"
                  >
                    {{ customer_arrears }}
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div v-if="show_amount" class="form-group row m-2">
            <h6 class="col-md-3">Amount</h6>
            <div class="col-md-6">
              <input
                class="form-control"
                type="number"
                placeholder="Amount"
                min="1000"
                v-model="amount"
              />
            </div>
          </div>
          <div v-if="showpurchased_code" class="form-group row m-2">
            <h6 class="col-md-3">Token</h6>
            <div class="col-md-6">
             {{ purchased_code }}
            </div>
          </div>
          <div class="form-group row m-2">
            <div class="col-md-3"></div>
            <button
              v-if="!confirmed"
              @click="confirmDetail"
              type="button"
              class="btn btn-success"
            >
              Confirm Detail
            </button>
            <button v-else type="submit" class="btn btn-success">
              Buy Token
            </button>
          </div>
        </div>
      </form>
      <!--end::Form-->
    </div>
    <!--end::Card-->
  </div>
</template>
  
  <script>
export default {
  props: ["user"],
  data() {
    return {
      service_type: "",
      meter_type: "",
      meter_number: "",
      show_details: false,
      customer_name: "",
      customer_address: "",
      customer_arreaars: "",
      transfer_status: false,
      confirmed: false,
      amount: "",
      show_amount: false,
      purchased_code : '',
      showpurchased_code : false

    };
  },
  methods: {
    fetchDiscount() {
      if (this.amount.length >= 2) {
        this.discountedAmount = this.amount - 0.02 * this.amount;
      }
    },
    confirmDetail() {
      if (
        this.service_type.length >= 1 &&
        this.meter_type.length >= 1 &&
        this.meter_number.length >= 9
      ) {
        console.log(this.service_type, this.meter_number, this.meter_type);
        Swal.fire({
          title: "Fetching meter details, please wait...",
          html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });
        let fd = new FormData();
        fd.append("service_type", this.service_type);
        fd.append("meter_type", this.meter_type);
        fd.append("meter_number", this.meter_number);
        axios
          .post("fetch_meter_details", fd)
          .then((response) => {
            console.log(response.data);
            if (response.data.success == "true") {
              Swal.close();
              this.show_details = true;
              this.confirmed = true;
              this.show_amount = true;
              this.customer_name = response.data.message.content.Customer_Name;
              this.customer_address = response.data.message.content.Address;
              this.customer_arrears =
                response.data.message.content.Customer_Arrears;
            } else {
              Swal.close();
              Swal.fire("error", response.data.message, "error");
            }
          })
          .catch((error) => {
            Swal.close();
            Swal.fire("An error eccoured, please try again later");
            console.log(error.message);
          });
      } else {
        Swal.fire("Please fill all neccessary fields");
      }
    },
    buyElectricity() {
      if (this.amount.length >= 3 && this.meter_type.length >= 1) {
        Swal.fire({
          // title:
          //   "You are about to purchase" +
          //   this.selectedPlan.plan_name +
          //   " of NGN " +
          //   this.amount,
          title: "Input your four(4) digit pin to proceed",
          icon: "warning",
          input: "password",
          inputAttributes: {
            inputmode: "numeric",
            maxlength: 4,
            autocomplete: "new-password",
            name: "my-pin",
            autocapitalize: "off",
            pattern: "[0-9]*",
            style: "text-align:center;font-size:24px;letter-spacing: 20px",
          },
          showCancelButton: true,
          confirmButtonColor: "#ebab21",
          cancelButtonColor: "grey",
          confirmButtonText: "Proceed",
          allowOutsideClick: false,
          allowEscapeKey: false,
          preConfirm: () => {
            const confirmButton = Swal.getConfirmButton();
            confirmButton.textContent = "Validating ";
            confirmButton.disabled = true;
            confirmButton.insertAdjacentHTML(
              "beforeend",
              `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
            );
            return new Promise((resolve) => {
              // You can perform any necessary validation here, e.g. making a server call.
              // Once validation is complete, call resolve() to close the modal.
              setTimeout(() => {
                resolve();
              }, 500);
            });
          },

          inputValidator: (text) => {
            if (!/^\d{4}$/.test(text)) {
              return "Please enter a four-digit PIN";
            }
          },
        }).then((result) => {
        Swal.fire({
          title: "Purchasing electricity token, please wait...",
          // html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });
        let fd = new FormData();
        fd.append("company", this.service_type);
        fd.append("meter_type", this.meter_type);
        fd.append("meter_number", this.meter_number);
        fd.append("amount", this.amount);
        fd.append("pin", result.value);
        axios
          .post("/buyElectricity", fd)
          .then((response) => {
            console.log(response);
            if (response.data.success == "true") {
              Swal.fire({
                icon: "success",
                title: "Token Purchase successful!",
                text: response.data.message.purchased_code,
                showConfirmButton: true, // updated
                confirmButtonColor: "#3085d6", // added
                confirmButtonText: "Ok", // added
                allowOutsideClick: false, // added to prevent dismissing the modal by clicking outside
                allowEscapeKey: false, // added to prevent dismissing the modal by pressing Esc key
              }).then((result) => {
                if (result.isConfirmed) {
                  // location.reload();
                  this.showpurchased_code = true
                  this.purchased_code = response.data.message.purchased_code
                }
              });
            } else {
              Swal.fire({
                icon: "error",
                title: response.data,
                // text: "Updating...",
                showConfirmButton: true, // updated
                confirmButtonColor: "#3085d6", // added
                confirmButtonText: "Ok", // added
                allowOutsideClick: false, // added to prevent dismissing the modal by clicking outside
                allowEscapeKey: false, // added to prevent dismissing the modal by pressing Esc key
              }).then((result) => {
                if (result.isConfirmed) {
                  // location.reload();
                }
              });
            }
          })
          .catch((error) => {
            console.log(error.message);
            Swal.fire(error.message);
          });
          });
      } else {
        Swal.fire("Insufficient balance");
      }
    },
  },
};
</script>
  
  <style>
</style>