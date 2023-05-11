<template>
  <!--begin::Profile Account Information-->
  <div class="row">
    <div class="col-md-12">
      <!--begin::Card-->
      <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
          <div class="card-title">
            <h3 class="card-label">
              Failed Imported Accounts
              <span class="text-muted pt-2 font-size-bg d-block">{{
                payroll.title
              }}</span>
            </h3>
          </div>
          <div class="card-toolbar">
            <!--begin::Dropdown-->

            <!--end::Dropdown-->
            <!--begin::Button-->
            <a href="#" class="btn btn-primary font-weight-bolder">
              <span class="svg-icon svg-icon-md">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Design/Flatten.svg-->
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
                    <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                    <path
                      d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                      fill="#000000"
                      opacity="0.3"
                    ></path>
                  </g>
                </svg>
                <!--end::Svg Icon--> </span
              >Clear All</a
            >
            <!--end::Button-->
          </div>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Acct. Name</th>
                <th scope="col">Acct. No.</th>
                <th scope="col">Bank Name</th>
                <th scope="col">Amount</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr :class="'ss' + fail.id" v-for="fail in failed" :key="fail.id">
                <td>
                  <div
                    :class="'s' + fail.id"
                    :id="'saccount_name' + fail.id"
                    class="symbol symbol-45px me-2"
                  >
                    <a
                      href="#"
                      class="text-dark fw-bold text-hover-primary mb-1 fs-6"
                      >{{ fail.account_name }}</a
                    >
                  </div>
                  <input
                    v-model="fail.account_name"
                    style="display: none"
                    :class="'r' + fail.id"
                    class="form-control form-control-sm"
                    type="text"
                    :id="'account_name' + fail.id"
                  />
                </td>
                <td>
                  <div
                        :class="'s' + fail.id"
                        :id="'saccount_no' + fail.id"
                        class="symbol symbol-45px me-2"
                      >
                        {{ fail.account_no }}
                      </div>
                      <input
                        style="display: none"
                        :id="'account_no' + fail.id"
                        :class="'r' + fail.id"
                        class="form-control form-control-sm"
                        type="number"
                        v-model="fail.account_no"
                      />
                </td>
                <td>
                  <span
                        :class="'s' + fail.id"
                        :id="'sbank_name' + fail.id"
                      >
                        {{ fail.bank_name }}
                      </span>
                      <select
                      
                        style="display: none"
                        :id="'bank_name' + fail.id"
                        :class="'r' + fail.id"
                        class="form-control form-control-sm"
                        type="text"
                        v-model="fail.bank_name"
                      >
                        <option value="">Select a bank</option>
                        <option
                          v-for="bank in banks"
                          :key="bank.id"
                          :value="bank.name"
                          :data-code="bank.code"
                        >
                          {{ bank.name }}
                        </option>
                      </select>
                </td>
                <td> <span
                        :class="'s' + fail.id"
                        :id="'samount' + fail.id"
                      >
                        {{
                          fail.amount.toLocaleString("en-US", {
                            style: "currency",
                            currency: "NGN",
                          })
                        }} </span
                      >
                     
                      <input
                        style="display: none"
                        :id="'amount' + fail.id"
                        :class="'r' + fail.id"
                        class="form-control form-control-sm"
                        type="number"
                        v-model="fail.amount"
                      />
                    </td>
                <td><a class="badge badge-danger">Failed</a></td>
                <td>
                  <a
                          @click="editFail(fail.id)"
                          href="javascript:;"
                          :class="'s' + fail.id"
                          class="btn btn-sm btn-clean btn-info"
                          title="Edit details"
                        >
                          Edit
                        </a>
                        <div style="display: none" :class="'r' + fail.id">
                        <button
                          @click="updateFail(fail.id)"
                          class="btn btn-success btn-sm p-2"
                        >
                          Re-import
                        </button>
                      </div>
                </td>
              </tr>
            </tbody>
          </table>
          <!--end: Datatable-->
        </div>
      </div>
      <!--end::Card-->
    </div>
    <!--end::Content-->
  </div>
  <!--end::Profile Account Information-->
</template>

<script>
export default {
  props: ["failed", "payroll","banks"],
  data() {
    return {};
  },
  methods : {
    editFail(payee_id) {
      console.log(payee_id);

      $(".s" + payee_id).hide();
      $(".r" + payee_id).show();
      // this.editForm = false
    },
    
    updateFail(payee_id) {
      console.log(
        $("#account_name" + payee_id).val(),
        $("#bank_name" + payee_id).val()
      );
      if(  $("#account_name" + payee_id).val().length < 2 ||  $("#amount" + payee_id).val().length <= 2 ||$("#account_no" + payee_id).val().length < 10 || $("#bank_name" + payee_id).val() == null) {
        Swal.fire('Please fill all the neccessary fields appropritely')
        return false
      }
      
      let fd = new FormData();
      fd.append("account_name", $("#account_name" + payee_id).val());
      fd.append("account_no", $("#account_no" + payee_id).val());
      fd.append("bank_name", $("#bank_name" + payee_id).val());
      fd.append(
        "bank_code",
        document
          .getElementById("bank_name" + payee_id)
          .options[
            document.getElementById("bank_name" + payee_id).selectedIndex
          ].getAttribute("data-code")
      );
      fd.append("amount", $("#amount" + payee_id).val());
      fd.append("payroll_id", this.payroll.uuid);
      fd.append("id",payee_id);
    
      axios
        .post("/update_failed_account", fd)
        .then((response) => {
          console.log(response.data,'reach here');
          if(response.data == 1) {
            Swal.fire('Payee re-imported successfully!')
            $(".ss" + payee_id).remove();
          }
          else {
            Swal.fire('Invalid account details!')
           
          }
        })
        .catch((error) => {
          console.log(error.message,'error here');
          Swal.fire('Invalid account details!')
           
        });
      $(".r" + payee_id).hide();
      $(".s" + payee_id).show();
    },
  },
  mounted() {
    console.log(this.failed);
  },
};
</script>

<style>
</style>