<template>
  <div class="col-md-12">
    <!--begin::Card-->
    <div class="card card-custom">
      <!--begin::Header-->
    
      <!--end::Header-->
      <!--begin::Form-->
      <form class="form" @submit.prevent="makeTransfer()">
        <div class="card-body">
          <!--begin::Heading-->

          <div class="row">
            <label class="col-md-3"></label>
            <div class="col">
              <div class="font-weight-bold">Make Transfer</div>
            </div>
            <div class="col text-end">
              <a onclick="window.history.back()" class="btn-sm btn btn-secondary">Back</a>
            </div>
          </div>
          <!--begin::Form Group-->
          <div class="form-group row m-2">
            <h6 class="col-md-3">Account ID</h6>
            <div class="col-md-6">
              <input
                v-model="account_id"
                @input="verifyAccount"
                class="form-control form-control-lg form-control-solid"
                type="text"
                placeholder="08000000000"
              />
            </div>
          </div>
          <div class="form-group row m-2">
            <h6 class="col-md-3">Account Name</h6>
            <div class="col-md-6">
              <input
                readonly
                v-model="account_name"
                class="form-control form-control-lg form-control-solid"
                type="text"
              />
            </div>
          </div>
          <div class="form-group row m-2">
            <h6 class="col-md-3">Amount</h6>
            <div class="col-md-6">
              <input
                v-model="amount"
                class="form-control form-control-lg form-control-solid"
                type="text"
                value=""
              />
            </div>
          </div>
          <div class="form-group row m-2">
            <div class="col-md-3"></div>
            <button
              :disabled="!transfer_status"
              type="submit"
              class="col-md-6 btn btn-success"
            >
              Transfer
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
      account_id: "",
      account_name: "",
      amount: "",
      transfer_status: false,
    };
  },
  methods: {
    myHistory() {
      alert("nice one");
    },
    verifyAccount() {
      if (this.account_id.length >= 10) {
        let fd = new FormData();
        fd.append("account_id", this.account_id);
        axios
          .post("/verify_id", fd)
          .then((response) => {
            console.log(response);
            if (response.data == false) {
              this.transfer_status = false;
              this.account_name = "Invalid Account ID";
            } else {
              this.account_name = response.data;
              this.transfer_status = true;
            }
          })
          .catch((error) => {
            this.transfer_status = false;
            console.log(error.message);
          });
      } else {
        this.transfer_status = false;
        this.account_name = "";
      }
    },
    makeTransfer() {
      if (
        this.transfer_status &&
        this.user.balance >= this.amount &&
        this.amount >= 100
      ) {
        Swal.fire({
          title:
            "You are about to send NGN" +
            this.amount +
            " to " +
            this.account_name,
          text: "Input your four(4) digit pin to proceed",
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
          confirmButtonText: "Make Transfer",
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
          if (result.isConfirmed) {
            Swal.fire("Making transfer, please wait...");
            let fd = new FormData();
            fd.append("account_id", this.account_id);
            fd.append("amount", this.amount);
            fd.append("pin", result.value);
            axios
              .post("/make_transfer", fd)
              .then((response) => {
                if (response.data == true) {
                  Swal.fire({
                    icon: "success",
                    title: "Transfer successful!",
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
          }
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