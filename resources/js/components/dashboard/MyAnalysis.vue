<template>
  <div id="kt_app_content" class="col-md-12">
    <!--begin::Content menu-->

    <!--begin::Content menu-->
    <!--begin::Row-->
  
    <!--end::Row-->
    <div class="row gx-5 gx-xl-10 mb-4">
    
      <div class="col-xl-6 mb-5 mb-xl-0">
        <!--begin::Chart widget 30-->
        <div class="card card-flush">
          <!--begin::Header-->
          <div class="card-header pt-7">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
             
              <span class="alert alert-info"
                >
                This analysis is conducted based on all orders associated with the contact number:  <span class="text-danger">{{ phone }}</span>. If this phone number is not the one you typically use for placing orders, please kindly update it below.</span
              >
            </h3>
            <!--end::Title-->

            <!--begin::Toolbar-->
         
            <!--end::Toolbar-->
          </div>
          <!--end::Header-->

          <!--begin::Body-->
          <div class="card-body d-flex justify-content-between flex-column">
            <!--begin::Items-->
          <form method='post' action="/changePhoneAnalysis">
            <label>Your main ordering phone number</label>
          <input name="phone" placeholder="Phone number used while ordering" type="number" class="form-control"/>
            <button type="submit" class="btn btn-success btn-sm">Fetch Analysis</button>
        </form>
            

           
          </div>
          <!--end::Body-->
        </div>
        <!--end::Chart widget 30-->
      </div>
      <div class="col-xl-6 mb-5 mb-xl-0">
        <!--begin::Chart widget 30-->
        <div class="card card-flush">
          <!--begin::Header-->
          <div class="card-header pt-7 mb-7">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bold text-gray-800"
                >My Order Analysis On CT_Taste</span
              >
              <span class="text-gray-400 mt-1 fw-semibold fs-6"
                >We keep good record, so you can streamline your finances</span
              >
            </h3>
            <!--end::Title-->

            <!--begin::Toolbar-->
            <div class="card-toolbar">
              <a
                href="pdf/report"
                class="btn btn-sm btn-light"
                >PDF Report</a
              >
            </div>
            <!--end::Toolbar-->
          </div>
          <!--end::Header-->

          <!--begin::Body-->
          <div class="card-body d-flex justify-content-between flex-column">
            <!--begin::Items-->
            <div class="d-flex flex-wrap d-grid">
              <!--begin::Item-->
              <div
                class="border-end-dashed border-end border-gray-300 pe-xxl-7 me-xxl-5"
              >
                <!--begin::Statistics-->
                <div class="d-flex mb-2">
                  <span class="fs-4 fw-semibold text-gray-400 me-1">N</span>
                  <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2"
                    >{{ formattedCurrency }}</span
                  >
                </div>
                <!--end::Statistics-->

                <!--begin::Description-->
                <span class="fs-6 fw-semibold text-gray-400"
                  >Total order since you start using CT_Taste</span
                >
                <!--end::Description-->
              </div>
              <!--end::Item-->

              <!--begin::Item-->
              <div class="m-0">
                <!--begin::Statistics-->
                <div class="d-flex align-items-center mb-2">
                  <!--begin::Currency-->
                  <span
                    class="fs-4 fw-semibold text-gray-400 align-self-start me-1"
                    >N</span
                  >
                  <!--end::Currency-->

                  <!--begin::Value-->
                  <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2"
                    >{{ convert_price(this_year) }}</span
                  >
                  <!--end::Value-->

                  <!--begin::Label-->
                  <span class="badge badge-light-success fs-base">
                    <i
                      class="ki-outline ki-arrow-up fs-5 text-success ms-n1"
                    ></i>
                    4.5%
                  </span>
                  <!--end::Label-->
                </div>
                <!--end::Statistics-->

                <!--begin::Description-->
                <span class="fs-6 fw-semibold text-gray-400">Your order this year</span>
                <!--end::Description-->
              </div>
              <div class="m-0">
                <!--begin::Statistics-->
                <div class="d-flex align-items-center mb-2">
                  <!--begin::Currency-->
                  <span
                    class="fs-4 fw-semibold text-gray-400 align-self-start me-1"
                    >N</span
                  >
                  <!--end::Currency-->

                  <!--begin::Value-->
                  <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2"
                    >{{ convert_price(this_month) }}</span
                  >
                  <!--end::Value-->

                  <!--begin::Label-->
                  <span class="badge badge-light-success fs-base">
                    <i
                      class="ki-outline ki-arrow-up fs-5 text-success ms-n1"
                    ></i>
                    4.5%
                  </span>
                  <!--end::Label-->
                </div>
                <!--end::Statistics-->

                <!--begin::Description-->
                <span class="fs-6 fw-semibold text-gray-400">Your order this month</span>
                <!--end::Description-->
              </div>
              <!--end::Item-->
            </div>
            <!--end::Items-->
            

           
          </div>
          <!--end::Body-->
        </div>
        <!--end::Chart widget 30-->
      </div>
    <!--end::Col-->
  </div>
    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
      <!--begin::Col-->
      <div class="col-xl-12 mb-5 mb-xl-10">
        <!--begin::Table widget 9-->
        <div class="card card-flush h-xl-100">
          <!--begin::Header-->
          <div class="card-header pt-5">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bold text-gray-800"
                >Top Restaurants You Ordered From</span
              >

             
            </h3>
            <!--end::Title-->

          </div>
          <!--end::Header-->

          <!--begin::Body-->
          <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
              <!--begin::Table-->
              <table class="table table-row-dashed align-middle gs-0 gy-4">
                <!--begin::Table head-->
                <thead>
                  <tr class="fs-7 fw-bold border-0 text-gray-400">
                    <th class="min-w-150px" colspan="2">Restaurant Name</th>
                    <th class="min-w-150px text-end pe-0" colspan="2">
                      Amount
                    </th>
                    <th class="text-end min-w-150px" colspan="2">
                      % RATE
                    </th>
                  </tr>
                </thead>
                <!--end::Table head-->

                <!--begin::Table body-->
                <tbody>
                  <tr v-for='rest in total_price_by_restaurant' :key="rest.total_price">
                    <td class="" colspan="2">
                      <a
                        href="#"
                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6"
                        >{{ rest.restaurant_name }}</a
                      >
                    </td>

                    <td class="pe-0" colspan="2">
                      <div class="d-flex align-items-center justify-content-end"> 
                            <!--begin::Number-->           
                            <span class="text-gray-800 fw-bold fs-4 me-3">{{ convert_price(rest.total_price) }}</span> 
                            <!--end::Number-->                        
                            
                            <!--begin::Info--> 
                                                            <!--begin::label--> 
                                <span class="badge badge-light-success fs-base">                                
                                    <i class="ki-outline ki-arrow-up fs-5 text-success ms-n1"></i>                                                              
                                        
                                    {{  rest.count }} times
                                </span>  
                                <!--end::label-->   
                                      
                            <!--end::Info-->                  
                        </div>
                      
                    </td>

                    <td class="" colspan="2">
                      <div class="d-flex justify-content-end">
                        <span class="text-success fw-bold fs-6 me-3">{{ ((rest.total_price / total_price) * 100).toFixed(2) }}%</span>

                       
                      </div>
                    </td>
                  </tr>
                </tbody>
                <!--end::Table body-->
              </table>
              <!--end::Table-->
            </div>
            <!--end::Table container-->
          </div>
          <!--end::Body-->
        </div>
        <!--end::Table Widget 9-->
      </div>
      <!--end::Col-->

     
    </div>
    <!--end::Row-->

    <!--begin::Row-->
   
    <!--end::Row-->
=
    <!--end::Row-->
  </div>
</template>

<script>
export default {
  props: ["user", "total_price", "total_price_by_restaurant","this_year","this_month",'phone'],
  data() {
    return {
      formattedCurrency: this.total_price.toLocaleString("en-US", {
        style: "currency",
        currency: "NGN",
      }),
    };
  },
  methods: {
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
              console.log(response, "the res");
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
          title: "Insufficient balance!,",
          icon: "info",
          html:
            "Click " +
            '<a href="https://fastpay.cttaste.com/fundwallet">here</a> ' +
            "to fund your wallet.",
          showCloseButton: true,
          showCancelButton: true,
          focusConfirm: false,
        });
      }
    },
    convert_price(price) {
      return price.toLocaleString("en-US", {
        style: "currency",
        currency: "NGN",
      })
    }
  },
};
</script>

<style>
</style>