<template>
  <div class="col-md-12">
    <!--begin::Card-->
    <div class="card card-custom">
      <!--begin::Header-->
    
      <!--end::Header-->
      <!--begin::Form-->
      <form class="form" @submit.prevent="buyCable()">
        <div class="card-body">
          <!--begin::Heading-->

          <div class="row">
            <label class="col-md-3"></label>
            <div class="col">
              <div class="font-weight-bold">Cable Subscription</div>
            </div>
            <div class="col text-end">
              <a onclick="window.history.back()" class="btn-sm btn btn-secondary">Back</a>
            </div>
          </div>
          <!--begin::Form Group-->
          <div class="form-group row m-2">
            <h6 class="col-md-3">Cable Type</h6>
            <div class="col-md-6">
              <select
                @change="changePlan"
                required
                v-model="cable_type"
                class="form-control"
              >
                <option value="">-- Select Cable Type --</option>
                <option value="01">DSTV</option>
                <option value="02">GOTV</option>
                <option value="03">STARTIMES</option>
              </select>
            </div>
          </div>

          <div class="form-group row m-2">
            <h6 class="col-md-3">Decoder Number</h6>
            <div class="col-md-6">
              <input
                class="form-control"
                type="number"
                min="1000"
                v-model="decoder_number"
              />
            </div>
          </div>
          <div v-if="show_decoder" class="form-group row m-2">
            <h6 class="col-md-3">Decoder Details</h6>
            <div class="col-md-6">
              <div class="d-flex align-items-center bg-light-info rounded p-5">
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
                  <span class="text-info font-weight-bold">Current Plan</span>
                  <a
                    href="#"
                    class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1"
                  >
                    {{ current_plan }}
                    <span style="color: red">({{ plan_status }})</span></a
                  >
                </div>
                <!-- <div class="d-flex flex-column flex-grow-1 mr-2">
                  <span class="text-info font-weight-bold">Due Date</span>
                  <a
                    href="#"
                    class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1"
                  >
                    {{ due_date }}</a
                  >
                </div> -->
                <!-- <div class="d-flex flex-column flex-grow-1 mr-2">
                  <span class="text-info font-weight-bold">Decoder Status</span>
                  <a
                    href="#"
                    class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1"
                  >
                    {{ plan_status }}</a
                  >
                </div> -->
                <!--end::Title-->
                <!--begin::Lable-->

                <!--end::Lable-->
              </div>

              <div class="form-group mt-4">
                <label>Subscription Type</label>
                <div class="radio-inline">
                  <label class="radio radio-lg">
                    <input
                      @click="renewPlan"
                      type="radio"
                      checked="checked"
                      name="radios3_1"
                    />
                    <span></span>Renew</label
                  >
                  <label class="radio radio-lg">
                    <input @click="fetchPlan" type="radio" name="radios3_1" />
                    <span></span>Change Plan</label
                  >
                </div>
              </div>
            </div>
          </div>
          <div v-if="!showPlan" class="form-group row m-2">
            <h6 class="col-md-3">Amount</h6>
            <div class="col-md-6">
              You will be charged : NGN {{ renewal_amount }}
            </div>
          </div>
          <div v-else class="form-group row m-2">
            <h6 class="col-md-3">Change Plan</h6>
            <div class="col-md-6">
              <select required v-model="selectedPlan" class="form-control">
                <!-- <option value="">Select Plan</option> -->
                <option
                  :data-price="plan.actual_price"
                  :key="plan.id"
                  v-for="plan in plans"
                  :value="plan.plan_id"
                >
                  {{ plan.plan_name }} - {{ plan.real_price }}
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row m-2">
            <div class="col-md-3"></div>
           
              <button
                v-if="showConfirm"
                @click="confirmDecoder"
                type="button"
                class="btn btn-success col-md-6"
              >
                Confirm Detail
              </button>
          
          
              <button
                v-else
                :disabled="!transfer_status"
                type="submit"
                class="btn btn-success col-md-6"
              >
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
      cable_type: "",
      meter_type: "",
      customer_name: "",
      current_plan: "",
      plan_status: "",
      showConfirm : true,
      due_data: "",
      decoder_number: "",
      transfer_status: false,
      showPlan: false,
      renewal_amount: 0,
      show_decoder: false,
      selectedPlan: null,
      amount: 0,
      plans: [],
    };
  },
  methods: {
    fetchPlan() {
      this.showPlan = true;
      axios
        .get("fetch_cable_plan/" + this.cable_type)
        .then((response) => {
          console.log(response.data);
          this.plans = response.data;
          this.selectedPlan = response.data[0].plan_id;
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    renewPlan() {
      this.showPlan = false;
      this.selectedPlan = "renew";
    },
    changePlan() {
      this.fetchPlan;
    },
    confirmDecoder() {
      console.log(this.cable_type, this.decoder_number);
      if (this.cable_type !== "" && this.decoder_number.length >= 10) {
        Swal.fire({
          title: "Fetching decoder details, please wait...",
          html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });
        let fd = new FormData();
        fd.append("cable_type", this.cable_type);
        fd.append("decoder_number", this.decoder_number);
        axios
          .post("fetch_decoder_details", fd)
          .then((response) => {
            console.log(
              response.data,
              response.data.success,
              response.data["success"]
            );
            if (response.data.success == "true") {
              Swal.close();
              this.show_decoder = true;
              this.showConfirm = false
              this.customer_name = response.data.message.content.Customer_Name;
              this.current_plan = response.data.message.content.Current_Bouquet;
              this.plan_status = response.data.message.content.Status;
              this.due_date = response.data.message.content.Due_Date;
              this.renewal_amount =
                response.data.message.content.Renewal_Amount + 100;
              this.transfer_status = true;
              this.selectedPlan = "renew";
              this.amount = this.renewal_amount;
            }
          })
          .catch((error) => {
            console.log(error.message);
          });
      } else {
        Swal.fire("Fill the neccessary field correctly");
      }
    },
    buyCable() {
      if (this.transfer_status) {
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
          if(result.isConfirmed == false) {
          return;

          }
        Swal.fire({
          title: "Purchasing data, please wait...",
          // html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });
        let fd = new FormData();
        fd.append("cable_type", this.cable_type);

        fd.append("plan", this.selectedPlan);
        fd.append("amount", this.renewal_amount);
        fd.append("decoder_number", this.decoder_number);
        fd.append("pin", result.value);
        axios
          .post("/buyCable", fd)
          .then((response) => {
            console.log(response.data);
            if (response.data.success == "true") {
              Swal.fire({
                icon: "success",
                title: "Purchase successful!",
                // text: "Updating...",
                showConfirmButton: true, // updated
                confirmButtonColor: "#3085d6", // added
                confirmButtonText: "Ok", // added
                allowOutsideClick: false, // added to prevent dismissing the modal by clicking outside
                allowEscapeKey: false, // added to prevent dismissing the modal by pressing Esc key
              }).then((result) => {
                if (result.isConfirmed) {
                  location.reload();
                }
              });
            } else {
              Swal.fire({
                icon: "error",
                title: response.data.message,
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
        Swal.fire({
                title: 'Insufficient balance!,',
                icon: 'info',
                html:
                    'Click ' +
                    '<a href="https://fastpay.cttaste.com/fundwallet">here</a> ' +
                    'to fund your wallet.',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
              
                })
      }
    },
  },
};
</script>
    
    <style>
</style>