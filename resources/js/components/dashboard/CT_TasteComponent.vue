<template>
  <div class="col-md-12">
    <!--begin::Card-->
    <div class="card card-custom">
      <!--begin::Header-->
     
      <!--begin::Form-->
      <form class="form" @submit.prevent="makeTransfer()">
        <div class="card-body">
          <!--begin::Heading-->

          <div class="row">
            <label class="col-md-3"></label>
            <div class="col">
              <div class="font-weight-bold">Pay For Food Order</div>
            </div>
            <div class="col text-end">
              <a onclick="window.history.back()" class="btn-sm btn btn-secondary">Back</a>
            </div>
          </div>
          <!--begin::Form Group-->
          <div class="form-group row m-2">
            <h6 class="col-md-3">Order ID</h6>
            <div class="col-md-6">
              <input
                v-model="order_id"
                @input="verifyAccount"
                class="form-control form-control-lg form-control-solid"
                type="text"
                placeholder="CTS-ABCDEFGH"
              />
            </div>
          </div>
          <div v-if="showStatus">
            <div class="form-group row m-2">
              <h6 class="col-md-3">Payment Status</h6>
              <div class="col-md-6">
                <div class="alert alert-success" v-if="payStatus">Paid</div>
                <div class="alert alert-danger" v-else>Not Paid</div>
              </div>
            </div>
            <div class="form-group row m-2">
              <h6 class="col-md-3">Restaurant Name</h6>
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
              <h6 class="col-md-3">Total Payable Amount</h6>
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
              <h6 class="col-md-3">Payer's Details</h6>
              <div class="col-md-6">
                <input
                  v-model="beneficial_name"
                  class="form-control form-control-lg form-control-solid"
                  type="text"
                  value=""
                />
              </div>
            </div>
            <div class="form-group row m-2">
              <h6 class="col-md-3">Delivery Address</h6>
              <div class="col-md-6">
                <input
                  v-model="delivery_address"
                  class="form-control form-control-lg form-control-solid"
                  type="text"
                  value=""
                />
              </div>
            </div>
            <div class="form-group row m-2">
              <div class="col-md-3"></div>
              <button v-if="payStatus == 0"
                :disabled="!transfer_status"
                type="submit"
                class="col-md-6 btn btn-success"
              >
                Make Payment
              </button>
              <button v-else
              @click="processOrder"
               
                type="button"
                class="col-md-6 btn btn-success"
              >
                Proceed to whatsapp
              </button>
            </div>
          </div>
          <div v-else></div>
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
      order_id: "",
      account_name: "",
      amount: "",
      transfer_status: false,
      beneficial_name: "",
      delivery_address: "",
      showStatus: false,
      payStatus: false,
      
    };
  },
  mounted() {
    this.order_id = this.getSlugFromUrl();
    this.verifyAccount()
  },
  updated() {
   
  },
  computed: {
    formattedBalance() {
      return this.numberFormat(this.user.balance);
    }
  },
  methods: {
    numberFormat(value) {
      return value.toLocaleString();
    },
    getSlugFromUrl() {
      const url = window.location.href;
      const parts = url.split('/');
      const slug = parts[parts.length - 1];
      if(slug == 'pay_cttaste') {
        return null;
      }
      return slug;
    },
    verifyAccount() {
      if (this.order_id.length >= 9) {
        // Swal.fire({
        //   title: "Fetching order details, please wait...",
        //   // html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
        //   showConfirmButton: false,
        //   allowOutsideClick: false,
        //   allowEscapeKey: false,
        //   didOpen: () => {
        //     Swal.showLoading();
        //   },
        // });
        let fd = new FormData();
        fd.append("order_id", this.order_id);
        axios
          .post("/verify_order", fd)
          .then((response) => {
            console.log(response);
            // Swal.close()
            if (response.data == false) {
              this.transfer_status = false;
              this.account_name = "Invalid Order ID";

              this.amount = 0.0;
              this.beneficial_name = "Invalid Order ID";
              this.delivery_address = "Invalid Order ID";
              this.transfer_status = true;
              this.showStatus = false;
              this.payStatus = false;
            } else {
              this.showStatus = true;
              // this.payStatus = false;
              this.payStatus = response.data.status;
              this.account_name = response.data.restaurant_name;
              this.amount = response.data.total_price;
              this.beneficial_name =
                response.data.name + " - " + response.data.phone;
              this.delivery_address =
                response.data.location + " - " + response.data.address;
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
        this.showStatus = false;
      }
    },
    processOrder() {
      let fd = new FormData()
      fd.append('order_id',this.order_id)
      axios
          .post("/process_order", fd)
          .then((response) => {
            console.log(response.data);
            // Swal.close()
            if (response.data.success !== true) {
              Swal.fire('Unable to process this order!','Kindly make a screenshot and send to the vendor','error')
             
            } else {
              window.location.replace(response.data.message)
             
            }
          })
          .catch((error) => {
           
            console.log(error.message);
          });
      
    },
    makeTransfer() {
      if (
        this.transfer_status &&
        this.user.balance >= this.amount &&
        this.amount >= 100
      ) {
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
        Swal.fire("Paying for order, please wait...");
        let fd = new FormData();
        fd.append("order_id", this.order_id);
        fd.append("amount", this.amount);
        fd.append("pin", result.value);
        axios
          .post("/pay_for_order", fd)
          .then((response) => {
            if(response.data == true) {
            console.log(response);
            Swal.fire({
              icon: "success",
              title: "Transfer successful!",
              showConfirmButton: true,
            }).then((result) => {
              if (result.isConfirmed) {
                let fd = new FormData()
                  fd.append('order_id',this.order_id)
                  axios
                      .post("/process_order", fd)
                      .then((response) => {
                        console.log(response.data);
                        // Swal.close()
                        if (response.data.success !== true) {
                          Swal.fire('Unable to process this order!','Kindly make a screenshot and send to the vendor','error')
                        
                        } else {
                          window.location.replace(response.data.message)
                        
                        }
                      })
                      .catch((error) => {
                      
                        console.log(error.message);
                      });
                  // location.reload();
                }
            });
          } else {
            Swal.fire({
              icon: "error",
              title: response.data,
              showConfirmButton: true,
            })
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