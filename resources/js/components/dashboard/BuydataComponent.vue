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
          <button onclick="history.back()" class="btn btn-secondary">Back</button>
        </div>
      </div>
      <!--end::Header-->
      <!--begin::Form-->
      <form class="form" @submit.prevent="buyData()">
        <div class="card-body">
          <!--begin::Heading-->

          <div class="row">
            <label class="col-xl-3"></label>
            <div class="col-lg-9 col-xl-6">
              <h5 class="font-weight-bold mb-6">Buy Data</h5>
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
                type="text"
                placeholder="08000000000"
              />
            </div>
          </div>
          <div class="form-group row m-2">
            <h6 class="col-md-3">Network</h6>
            <div class="col-md-6">
              <select
                required
                @change="fetchPlan()"
                v-model="network"
                class="form-control"
              >
                <option value="1">MTN</option>
                <option value="2">GLO</option>
                <option value="3">AIRTEL</option>
                <option value="4">9MOBILE</option>
              </select>
            </div>
          </div>
          <div class="form-group row m-2">
            <h6 class="col-md-3">Plan</h6>
            <div class="col-md-6">
              <select required v-model="selectedPlan" class="form-control">
                <!-- <option value="">Select Plan</option> -->
                <option
                  :data-price="plan.actual_price"
                  :key="plan.id"
                  v-for="plan in plans"
                  :value="plan.plan_id"
                >
                  {{ plan.plan_name }}
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row m-2">
            <div class="col-md-3"></div>
            <button
              :disabled="!transfer_status"
              type="submit"
              class="btn btn-success col-md-6"
            >
              Buy Data
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
      selectedPlan: "",
      plans: [],
      transfer_status: false,
    };
  },
  methods: {
    fetchNetwork() {
      if (this.phone_number.length >= 10 && this.phone_number.length <= 12) {
        axios
          .get("/fetchnetwork/" + this.phone_number)
          .then((response) => {
            console.log(response);
            if (response.data !== 0) {
              this.network = response.data;
              this.fetchPlan();
              this.transfer_status = true;
            }
          })
          .catch((error) => {
            this.transfer_status = false;
            console.log(error.message);
          });
      } else {
        (this.selectedPlan = null), (this.plans = []);
        this.network = null;
        this.transfer_status = false;
        // this.network = "";
      }
    },
    fetchPlan() {
      if (this.phone_number.length >= 10) {
        axios
          .get("/fetchplan/" + this.network)
          .then((response) => {
            console.log(response);
            if (response.data !== false) {
              this.selectedPlan = response.data[0].plan_id;
              this.plans = response.data;
              this.transfer_status = true;
            }
          })
          .catch((error) => {
            this.transfer_status = false;
            console.log(error.message);
          });
      } else {
        // this.transfer_status = false;
        // this.network = "";
      }
    },
    buyData() {
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
          confirmButtonText: "Buy Data",
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
        fd.append("phone_number", this.phone_number);
        fd.append("network", this.network);
        fd.append("plan", this.selectedPlan);
        fd.append("pin", result.value);
        axios
          .post("/buydata", fd)
          .then((response) => {
            if (response.data.success == "true") {
              Swal.fire({
                icon: "success",
                title: "Purchase successful!",
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
        }) 
      } else {
        Swal.fire("Insufficient balance");
      }
    },
  },
};
</script>

<style>
</style>