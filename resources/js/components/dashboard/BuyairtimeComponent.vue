<template>
  <div class="col-md-12">
    <!--begin::Card-->
    <div class="card card-custom">
      <!--begin::Header-->
     
      <!--end::Header-->
      <!--begin::Form-->
      <form class="form" @submit.prevent="buyAirtime()">
        <div class="card-body">
          <!--begin::Heading-->

          <div class="row">
            <label class="col-md-3"></label>
            <div class="col">
              <div class="font-weight-bold">Buy Airtime</div>
            </div>
            <div class="col text-end">
              <a onclick="window.history.back()" class="btn-sm btn btn-secondary">Back</a>
            </div>
          </div>
          <!--begin::Form Group-->
          <div class="form-group row m-2">
            <h6 class="col-md-3">Phone Number</h6>
            <div class="col-md-6">
              <input
                required
                @input="fetchNetwork()"
                v-model="phone_number"
                class="form-control form-control-lg form-control-solid"
                type="number"
                minlength="10"
                maxlength="11"
                placeholder="08000000000"
              />
            </div>
          </div>
          <div class="form-group row m-2">
            <h6 class="col-md-3">Network</h6>
            <div class="col-md-6">
              <select
                @change="fetchDiscount()"
                v-model="network"
                class="form-control"
              >
                <option value="1">MTN (2% off for every recharge)</option>
                <option value="2">GLO (2% off for every recharge)</option>
                <option value="3">AIRTEL (2% off for every recharge)</option>
                <option value="4">9MOBILE (2% off for every recharge)</option>
              </select>
            </div>
          </div>
          <div class="form-group row m-2">
            <h6 class="col-md-3">Amount</h6>
            <div class="col-md-6">
              <input
                required
                @input="fetchDiscount"
                class="form-control"
                v-model="amount"
                placeholder="Amount"
              />
              You will be charged : {{ discountedAmount }}
            </div>
          </div>
          <div class="form-group row m-2">
            <div class="col-md-3"></div>
            <button
              :disabled="!transfer_status"
              type="submit"
              class="btn btn-success"
            >
              Buy Airtime
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
      phone_number: "",
      network: "",
      amount: "",
      discountedAmount: 0,

      transfer_status: false,
    };
  },
  mounted() {},
  methods: {
    fetchNetwork() {
      if (this.phone_number.length >= 10 && this.phone_number.length <= 12) {
        axios
          .get("/fetchnetwork/" + this.phone_number)
          .then((response) => {
            console.log(response);
            if (response.data !== 0) {
              this.network = response.data;

              this.transfer_status = true;
            }
          })
          .catch((error) => {
            this.transfer_status = false;
            console.log(error.message);
          });
      } else {
        (this.amount = null), (this.plans = []);
        this.network = null;
        this.transfer_status = false;
        // this.network = "";
      }
    },
    fetchDiscount() {
      if (this.amount.length >= 2) {
        this.discountedAmount = this.amount - 0.02 * this.amount;
      }
    },
    buyAirtime() {
      if (this.transfer_status && this.amount.length > 2) {
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
          confirmButtonText: "Buy Airtime",
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
          title: "Purchasing airtime, please wait...",
          // html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
          showConfirmButton: false,
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });
        let fd = new FormData();
        fd.append("phone_number", this.phone_number);
        fd.append("network", this.network);
        fd.append("amount", this.amount);
        fd.append("discounted_amount", this.discountedAmount);
        fd.append("pin", result.value);
        axios
          .post("/buyairtime", fd)
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
        })
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