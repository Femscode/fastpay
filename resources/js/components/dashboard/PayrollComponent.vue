<template>
  <div>
    <div class="row">
      <div class="col-md-6 mb-2">
        <select @change="changePayroll" class="form-select form-control">
          <option
            v-for="(paye, index) in payrolls"
            :key="index"
            :value="paye.uuid"
          >
            {{ paye.title }}
          </option>
        </select>
      </div>
      <div class="col-md-6">
        <a
          href="#"
          class="btn btn-light-primary font-weight-bolder"
          data-bs-toggle="modal"
          data-bs-target="#add_new_payroll"
        >
          <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
          <span class="svg-icon svg-icon-3"
            ><svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <rect
                opacity="0.3"
                x="2"
                y="2"
                width="20"
                height="20"
                rx="5"
                fill="currentColor"
              />
              <rect
                x="10.8891"
                y="17.8033"
                width="12"
                height="2"
                rx="1"
                transform="rotate(-90 10.8891 17.8033)"
                fill="currentColor"
              />
              <rect
                x="6.01041"
                y="10.9247"
                width="12"
                height="2"
                rx="1"
                fill="currentColor"
              />
            </svg>
          </span>
          <!--end::Svg Icon-->
          <span class="ms-n1">Create New Payroll</span>
        </a>
      </div>
    </div>
    <div class="card mb-5 mb-xl-8">
      <!--begin::Header-->
      <div class="card-header border-0 pt-5">
        <h3 class="d-flex card-title">
          <span
            v-if="edit_payroll_title"
            class="card-label fw-bold fs-3 mb-1"
            :key="new_payroll.id"
            >{{ new_payroll.title }}
          </span>

          <form
            v-else
            class="form-group row"
            @submit.prevent="updatePayrollTitle"
          >
            <div class="input-group">
              <input
                class="form-control form-control-sm"
                v-model="new_payroll.title"
              />
              <button type="submit" class="btn-sm btn btn-success">
                Update
              </button>
            </div>
          </form>
          <a
            style="cursor: pointer"
            v-if="edit_payroll_title"
            @click="edit_payroll_title = !edit_payroll_title"
            ><i class="fa fa-edit"></i
          ></a>
        </h3>

        <div class="card-toolbar">
          <ul class="nav">
            <li class="nav-item">
              <a
                data-bs-toggle="modal"
                @click="eraseAll"
                class="nav-link btn btn-sm btn-light-secondary btn-active btn-secondary fw-bold px-4 me-1 active"
                v-bind:data-bs-target="'#' + new_payroll.uuid"
                >Add Manually</a
              >
            </li>

            <li class="nav-item" style="margin-right: 3px">
              <div class="">
                <button
                  data-bs-toggle="modal"
                  v-bind:data-bs-target="'#import_data' + new_payroll.uuid"
                  type="button"
                  class="nav-link btn-sm btn btn-light-primary px-4 me-1 fw-bold"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Design/PenAndRuller.svg-->
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
                          d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                          fill="#000000"
                          opacity="0.3"
                        ></path>
                        <path
                          d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                          fill="#000000"
                        ></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon--> </span
                  >Import
                </button>
                <!--begin::Dropdown Menu-->

                <!--end::Dropdown Menu-->
              </div>
            </li>

            <li class="nav-item">
              <button
                @click="generateLink(new_payroll.uuid)"
                class="ml-2 nav-link btn btn-sm btn-light-warning btn-active btn-active-success fw-bold px-4"
                data-bs-toggle="tab"
                href="#kt_table_widget_5_tab_3"
              >
                <span v-if="!new_payroll.live"> Generate Link </span>
                <span v-else> De-activate Link </span>
              </button>
            </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 float-right">
          <div v-if="new_payroll.live" class="d-flex">
            <input
              ref="myLink"
              class="form-control form-control-sm"
              :value="'https://paycirclex.com/' + new_payroll.uuid"
            />
            <a @click="copyLink" class="btn btn-info btn-sm"
              ><i class="fa fa-copy"></i
            ></a>
            <a @click="copyLink" class="btn btn-primary btn-sm"
              ><i class="fa fa-share-alt" aria-hidden="true"></i
            ></a>
          </div>
        </div>
      </div>

      <!--end::Header-->

      <!--begin::Body-->
      <div class="card-body py-3">
        <div class="tab-content">
          <!--begin::Tap pane-->

          <div class="tab-pane fade show active" id="kt_table_widget_5_tab_1">
            <!--begin::Table container-->
            <div class="table-responsive">
              <!--begin::Table-->
              <table
                ref="myTable"
                v-bind:id="'table' + new_payroll.uuid"
                class="datatable table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4"
              >
                <!--begin::Table head-->
                <thead>
                  <tr class="border-0">
                    <th>Acct. Name</th>
                    <th>Acct. No.</th>
                    <th>Bank Name</th>
                    <th>Amout</th>
                    <th>Action</th>
                    <th>Status</th>
                    <th style="display: none">Created At</th>
                  </tr>
                </thead>
                <!--end::Table head-->

                <!--begin::Table body-->
                <tbody>
                  <tr
                    :class="'ss' + paye.uuid"
                    v-for="(paye, payee_index) in new_payroll.payee"
                    :key="payee_index"
                  >
                    <td>
                      <div
                        :class="'s' + paye.uuid"
                        :id="'saccount_name' + paye.uuid"
                        class="symbol symbol-45px me-2"
                      >
                        <a
                          href="#"
                          class="text-dark fw-bold text-hover-primary mb-1 fs-6"
                          >{{ paye.account_name }}</a
                        >
                      </div>
                      <input
                        v-model="paye.account_name"
                        style="display: none"
                        :class="'r' + paye.uuid"
                        class="form-control form-control-sm"
                        type="text"
                        :id="'account_name' + paye.uuid"
                      />
                    </td>
                    <td>
                      <div
                        :class="'s' + paye.uuid"
                        :id="'saccount_no' + paye.uuid"
                        class="symbol symbol-45px me-2"
                      >
                        {{ paye.account_no }}
                      </div>
                      <input
                        style="display: none"
                        :id="'account_no' + paye.uuid"
                        :class="'r' + paye.uuid"
                        class="form-control form-control-sm"
                        type="number"
                        v-model="paye.account_no"
                      />
                    </td>
                    <td class="text-start text-muted fw-bold">
                      <span
                        :class="'s' + paye.uuid"
                        :id="'sbank_name' + paye.uuid"
                      >
                        {{ paye.bank_name }}
                      </span>
                      <select
                        style="display: none"
                        :id="'bank_name' + paye.uuid"
                        :class="'r' + paye.uuid"
                        class="form-control form-control-sm"
                        type="text"
                        v-model="paye.bank_name"
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
                    <td class="text-start text-muted fw-bold">
                      <span
                        :class="'s' + paye.uuid"
                        :id="'samount' + paye.uuid"
                      >
                        {{
                          paye.amount.toLocaleString("en-US", {
                            style: "currency",
                            currency: "NGN",
                          })
                        }} </span
                      ><br />
                      <p
                        style="color: red; font-size: 12px; font-style: italic"
                        >{{ paye.narration }}</p
                      >
                      <input
                        style="display: none"
                        :id="'amount' + paye.uuid"
                        :class="'r' + paye.uuid"
                        class="form-control form-control-sm"
                        type="number"
                        v-model="paye.amount"
                      />
                    </td>

                    <td class="">
                      <div
                        :class="'s' + paye.uuid"
                        class="d-flex justify-content-center align-items-center"
                      >
                        <span class="switch switch-icon">
                          <label class="switch">
                            <input
                              v-on:change="changePaymentStatus(paye.uuid)"
                              type="checkbox"
                              v-model="paye.pay_status"
                              :checked="paye.pay_status"
                              name="select"
                            />
                            <span class="slider"> </span>
                          </label>
                        </span>
                        <a
                          @click="editPayee(paye.uuid)"
                          href="javascript:;"
                          class="btn btn-sm btn-clean btn-icon"
                          title="Edit details"
                        >
                          <i class="la la-edit"></i>
                        </a>
                        <a
                          @click="deletePayee(paye.uuid)"
                          href="javascript:;"
                          class="btn btn-sm btn-clean btn-icon"
                          title="Delete"
                        >
                          <i class="la la-trash"></i>
                        </a>
                      </div>
                      <div style="display: none" :class="'r' + paye.uuid">
                        <button
                          @click="updatePayee(paye.uuid)"
                          class="btn btn-success btn-sm p-2"
                        >
                          Update
                        </button>
                      </div>
                    </td>

                    <td class="">
                      <span
                        v-if="paye.status == 1"
                        :class="'s' + paye.uuid"
                        class="badge badge-light-success"
                        >Success</span
                      >
                      <span
                        v-else-if="paye.status == 2"
                        :class="'s' + paye.uuid"
                        class="badge badge-light-warning"
                        >Pending</span
                      >
                      <span
                        v-else-if="paye.status == 0"
                        :class="'s' + paye.uuid"
                        class="badge badge-light-danger"
                        >Failed</span
                      >
                      <span
                        v-else
                        :class="'s' + paye.uuid"
                        class="badge badge-light-warning"
                        >Not Started</span
                      >
                      <a
                        style="cursor: pointer"
                        v-if="paye.status == 0"
                        @click="checkPaymentStatus(paye.payment_reference)"
                        :class="'s' + paye.uuid"
                        class="btn btn-warning btn-sm p-1 m-1"
                        >Check Reason</a
                      >
                    </td>

                    <td style="display: none">{{ paye.created_at }}</td>
                  </tr>
                </tbody>
                <!--end::Table body-->
              </table>
            </div>

            <!--end::Table-->
          </div>
        </div>
      </div>
      <div class="card-footer">
        <p v-if='failedAccount'>Some accounts are not imported, click <a :href="'/failed_account/' + new_payroll.uuid" style="cursor:pointer">here</a> to check them out.</p>
        <div class="row">
          <div class="col-md-6">
            <div class="input-group input-group-sm">
              <button class="btn btn-info btn-sm" type="button">
                Pay First
              </button>
              <select
                v-model="pick_first"
                @change="pickFirst"
                class="form-select-sm"
              >
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="50">50</option>
                <option value="70">70</option>
                <option value="100">100</option>
                <option value="150">150</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th class="pl-0 font-weight-bold text-muted text-uppercase">
                    <strong> Description </strong>
                  </th>
                  <th
                    class="text-right pr-0 font-weight-bold text-muted text-uppercase"
                  >
                    <b> Amount </b>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr class="font-weight-boldest font-size-lg">
                  <td class="pl-0 pt-7">Disbursement Fee</td>

                  <td class="text-danger pr-0 pt-7 text-right">
                    <span v-if="new_payroll.user_charge == 'payroll'">

                        {{
                        new_payroll.payee
                        .reduce((total, item) => total + item.amount, 0)
                        .toLocaleString("en-US", {
                          style: "currency",
                          currency: "NGN",
                        })
                      }}
                     
                      </span>
                      <span v-else>
                        {{
                        new_payroll.payee
                        .reduce((total, item) => total + item.amount + item.charges, 0)
                        .toLocaleString("en-US", {
                          style: "currency",
                          currency: "NGN",
                        })
                      }}
                      </span>
                  </td>
                </tr>

                <tr class="font-weight-boldest border-bottom-0 font-size-lg">
                  <td class="border-top-0 pl-0 py-4">Charges</td>

                  <td class="text-danger border-top-0 pr-0 py-4 text-right">
                    <span v-if="new_payroll.user_charge == 'payroll'">

                      {{
                        new_payroll.payee
                        .reduce((total, item) => total + item.charges, 0)
                        .toLocaleString("en-US", {
                          style: "currency",
                          currency: "NGN",
                        })
                      }}
                      </span>
                      <span v-else>NGN0</span>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <input
                      :checked="new_payroll.user_charge == 'payee'"
                      type="checkbox"
                      @change="payrollCharge"
                    />
                    <i class="text-muted" >
                      Remove charges from payee's account</i
                    >
                  
                    
                  </td>
                </tr>
                <tr class="font-weight-boldest border-bottom-0 font-size-lg">
                  <td class="border-top-0 pl-0 py-4">Total Amount</td>
                  <td>
                    {{
                      new_payroll.payee
                        .reduce(
                          (total, item) => total + item.amount + item.charges,
                          0
                        )
                        .toLocaleString("en-US", {
                          style: "currency",
                          currency: "NGN",
                        })
                    }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div v-if="new_payroll.is_processed" class="container">
          <div class="row mb-2">
            <div class="col-md-6">
              <button
                @click="checkStatus(new_payroll.uuid)"
                class="btn btn-light-warning font-weight-bold p-4 btn-sm w-100"
                style="
                  border: 2px dashed black;
                  font-size: 18px;
                  font-weight: 800;
                "
              >
                Check Status
              </button>
            </div>
            <div class="col-md-6">
              <button
                @click="initializePayment(new_payroll.uuid)"
                class="btn btn-light-success font-weight-bold p-4 btn-sm w-100"
                style="
                  border: 2px dashed green;
                  font-size: 18px;
                  font-weight: 800;
                "
              >
                Retry Failed Payment
              </button>
            </div>
          </div>
        </div>

        <div v-else class="container">
          <div class="row mb-2">
            <div class="col">
              <button
                @click="initializePayment(new_payroll.uuid)"
                class="btn btn-light-success font-weight-bold p-4 btn-sm w-100"
                style="
                  border: 2px dashed green;
                  font-size: 18px;
                  font-weight: 800;
                "
              >
                Initiate Payment
              </button>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row mb-2">
            <div class="col">
              <button
                @click="resetDefault(new_payroll.uuid)"
                type="button"
                class="btn btn-light-info font-weight-bold p-4 btn-sm w-100"
                style="
                  border: 2px dashed purple;
                  font-size: 18px;
                  font-weight: 800;
                "
              >
                Reset To Default
              </button>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col">
              <button
                @click="deletePayroll(new_payroll.uuid)"
                type="button"
                class="btn btn-light-danger font-weight-bold p-4 btn-sm w-100"
                style="
                  border: 2px dashed red;
                  font-size: 18px;
                  font-weight: 800;
                "
              >
                Delete {{ new_payroll.title }} Payroll
              </button>
            </div>
          </div>
        </div>
      </div>
      <!--end::Body-->

      <div
        class="modal fade"
        v-bind:id="'import_data' + new_payroll.uuid"
        tabindex="-1"
        aria-hidden="true"
      >
        <div class="modal-dialog mw-650px">
          <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
              <div
                class="btn btn-sm btn-icon btn-active-color-primary"
                data-bs-dismiss="modal"
              >
                <span class="svg-icon svg-icon-1"
                  ><svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <rect
                      opacity="0.5"
                      x="6"
                      y="17.3137"
                      width="16"
                      height="2"
                      rx="1"
                      transform="rotate(-45 6 17.3137)"
                      fill="currentColor"
                    />
                    <rect
                      x="7.41422"
                      y="6"
                      width="16"
                      height="2"
                      rx="1"
                      transform="rotate(45 7.41422 6)"
                      fill="currentColor"
                    />
                  </svg>
                </span>
              </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
              <div class="text-center mb-13">
                <h1 class="mb-3">Import Payee</h1>
              </div>
              <form @submit.prevent="importData(new_payroll.uuid)">
                <div class="form-group row">
                  <div
                    class="col-lg-12 alert alert-warning"
                    style="border: 2px dashed #856404"
                  >
                    <label class="text-dark"
                      >Upload File
                      <span style="color: red" class="text-red"
                        >Excel or CSV format</span
                      ></label
                    >
                    <p>
                      Please make sure the file you will be importing is of
                      <a href="/sample_import_data">this</a> format and you
                      input the bank names correctly.
                    </p>
                    <input
                      v-bind:id="'fileUpload' + new_payroll.uuid"
                      type="file"
                      class="form-control"
                      accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                      required
                    />
                  </div>
                </div>

                <div class="d-flex justify-content-center mt-2">
                  <button type="submit" class="btn btn-primary btn-block p-3">
                    Import To {{ new_payroll.title }}
                  </button>
                </div>
              </form>
              <!--begin::Users-->
              <div class="text-align-center justify-content-center">
                <input
                  type="checkbox"
                  v-on:click="available_bank = !available_bank"
                />
                Check available banks and their correct names format.
              </div>
              <select v-if="available_bank" class="form-control">
                <option>-- Check available and correct bank names --</option>
                <option v-for="bank in banks" :key="bank.id">
                  {{ bank.slug }}
                </option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div
        class="modal fade"
        v-bind:id="new_payroll.uuid"
        tabindex="-1"
        aria-hidden="true"
      >
        <div class="modal-dialog mw-650px">
          <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
              <div
                class="btn btn-sm btn-icon btn-active-color-primary"
                data-bs-dismiss="modal"
              >
                <span class="svg-icon svg-icon-1"
                  ><svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <rect
                      opacity="0.5"
                      x="6"
                      y="17.3137"
                      width="16"
                      height="2"
                      rx="1"
                      transform="rotate(-45 6 17.3137)"
                      fill="currentColor"
                    />
                    <rect
                      x="7.41422"
                      y="6"
                      width="16"
                      height="2"
                      rx="1"
                      transform="rotate(45 7.41422 6)"
                      fill="currentColor"
                    />
                  </svg>
                </span>
              </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
              <div class="text-center mb-13">
                <h1 class="mb-3">Add Payee</h1>
              </div>
              <form @submit.prevent="savePayee(new_payroll.uuid)">
                <div class="form-group row">
                  <div class="col-lg-6">
                    <label>Account Name:</label>
                    <input
                      v-model="account_name"
                      type="text"
                      class="form-control"
                      placeholder="Enter full name"
                      required
                    />
                  </div>
                  <div class="col-lg-6">
                    <label>Account Number:</label>
                    <input
                      v-model="account_no"
                      type="number"
                      class="form-control"
                      placeholder="Enter account number"
                      required
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-6">
                    <label for="bank-select">Select Bank:</label>
                    <select
                      class="form-control"
                      name="bank"
                      id="bank-select"
                      v-model="bank_name"
                      required
                    >
                      <option value="">-- Select a bank --</option>
                      <option
                        v-for="bank in banks"
                        :key="bank.id"
                        :value="bank.name"
                        :data-code="bank.code"
                      >
                        {{ bank.name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-lg-6">
                    <label>Amount(NGN):</label>
                    <input
                      v-model="amount"
                      type="number"
                      class="form-control"
                      placeholder="Enter amount "
                      required
                    />
                  </div>
                  <div class="col-lg-12">
                    <label
                      >Narration<span class="text-danger">(Optional)</span
                      >:</label
                    >
                    <textarea
                      v-model="narration"
                      type="text"
                      class="form-control"
                      placeholder="Enter narration"
                    ></textarea>
                  </div>
                </div>
                <div class="d-flex justify-content-center mt-2">
                  <button type="submit" class="btn btn-primary btn-block p-3">
                    Add To {{ new_payroll.title }}
                  </button>
                </div>
              </form>
              <!--begin::Users-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import $ from "jquery";
import "datatables.net";
export default {
  props: ["payroll", "payrolls", "banks"],
  data() {
    return {
      failedAccount : false,
      check_pay_status: 0,
      available_bank: false,
      edit_payroll_title: true,
      payroll_title: "",
      dataTable: null,
      amount: "",
      change_pay: false,
      account_name: "",
      narration: "",
      bank_name: "",
      account_no: "",
      new_payroll: this.payroll,
      selectedValue: this.payroll.title,
      pick_first: "All",
    };
  },
  methods: {
    savePayee(payroll_id) {
      Swal.fire("Validating account, please wait...");
      let fd = new FormData();
      fd.append("account_name", this.account_name);
      fd.append("account_no", this.account_no);
      fd.append("bank_name", this.bank_name);
      fd.append("narration", this.narration);
      fd.append(
        "bank_code",
        document
          .getElementById("bank-select")
          .options[
            document.getElementById("bank-select").selectedIndex
          ].getAttribute("data-code")
      );
      fd.append("amount", this.amount);
      fd.append("payroll_id", payroll_id);
      axios
        .post("/manual_add_payee", fd)
        .then((response) => {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });
          console.log(response.data, "the data");
          if (response.data == "account-not-found") {
            Toast.fire({
              icon: "error",
              title: "Invalid Account Number",
            });
          } else {
            (this.amount = ""),
              (this.account_name = ""),
              (this.bank_name = ""),
              (this.account_no = "");
            this.narration = "";
            console.log(response);
            var newRowHtml =
              "<tr><td><strong>" +
              response.data.account_name +
              "</strong></td></td>><td>" +
              response.data.account_no +
              "</td><td>" +
              response.data.bank_name +
              "</td>><td>" +
              response.data.amount.toLocaleString("en-US", {
                style: "currency",
                currency: "NGN",
              }) +
              "</td>" +
              // " class='d-flex justify-content-center align-items-center'></div><span class='switch switch-icon'><label class='switch'><input v-on:change=" +
              // this.changePaymentStatus(response.data.uuid) +
              // " type='checkbox' :checked=" +
              // response.data.pay_status +
              // "><span class='slider'></span></label></span><a @click=" +
              // this.editPayee(response.data.uuid) +
              // " href='javascript:;' class='btn btn-sm btn-clean btn-icon' title='Edit details'><i class='fa fa-edit'></i></a><a @click=" +
              // this.deletePayee(response.data.uuid) +
              // " href='javascript:;' class='btn btn-sm btn-clean btn-icon' title='Delete'><i class='la la-trash'></i></a></div><div style='display: none' :class=" +
              // "r" +
              // response.data.uuid +
              // "><button @click='' class='btn btn-success btn-sm p-2'>Update</button></div></td><td><span :class=" +
              // "s" +
              // response.data.uuid +
              // " class='badge badge-light-warning'>Not Started</span></td><td style='display:none'>" +
              // response.data.created_at +
              "</tr>";
            // Append the new rows to the table
            $("#table" + payroll_id).prepend(newRowHtml);
            // this.dataTable.DataTable().destroy();
            // this.change_pay = true;
            // this.pick_first = "All";

            Toast.fire({
              icon: "success",
              title: "Payee added successfully",
            });
          }

          // Swal.fire("success", "Payee added successfully", "success");
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    importData(payroll_id) {
      Swal.fire('Importing payee, please wait...')
      let fd = new FormData();
      const file = document.querySelector("#fileUpload" + payroll_id).files[0];
      fd.append("file", file);
      fd.append("payroll_id", payroll_id);
      axios
        .post("/import_add_payee", fd)
        .then((response) => {
          console.log(response);
          Swal.fire({
            icon: "success",
            title: "Payee Imported Successfully!",
            text: "Updating...",
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
          }).then((result) => {
            location.reload();
          });
        })
        .catch((error) => {
          console.log(error.message);
          Swal.fire('Unable to import payee, check the format of the file to be imported')
        });
    },
    deletePayee(payee_id) {
      // Do the swal confirm stuff
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Delete!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete("delete_payee/" + payee_id)
            .then((response) => {
              console.log(response);
              $(".ss" + payee_id).remove();

              //Swal.fire("deleted successfully");
            })
            .catch((error) => {
              console.log(error.message);
              Swal.fire(
                "Failed!",
                "Unable to delete, try again later",
                "error"
              );
            });
        }
      });
    },
    editPayee(payee_id) {
      console.log(payee_id);

      $(".s" + payee_id).hide();
      $(".r" + payee_id).show();
      // this.editForm = false
    },
    updatePayee(payee_id) {
      console.log(
        $("#account_name" + payee_id).val(),
        $("#bank_name" + payee_id).val()
      );
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
      fd.append("payee_id", payee_id);
      axios
        .post("/update_payee", fd)
        .then((response) => {
          console.log(response.data);
          $("#saccount_name" + payee_id).text(response.data.account_name);
          $("#saccount_no" + payee_id).text(response.data.account_no);
          $("#sbank_name" + payee_id).text(response.data.bank_name);
          $("#amount" + payee_id).text(response.data.amount);
        })
        .catch((error) => {
          console.log(error.message);
        });
      $(".r" + payee_id).hide();
      $(".s" + payee_id).show();
    },
    eraseAll() {
      (this.amount = ""),
        (this.account_name = ""),
        (this.bank_name = ""),
        (this.account_no = "");
    },
    initializePayment(payroll_id) {
      Swal.fire({
        title:
          `You are about to make a total payment of ` +
          this.new_payroll.payee
            .reduce((total, item) => {
              if (item.status == 1) {
                return total;
              }
              return total + item.amount + item.charges;
            }, 0)
            .toLocaleString("en-US", { style: "currency", currency: "NGN" }) +
          ` for ` +
          this.new_payroll.title,

        text: "Input your four(4) digit pin",
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
        confirmButtonColor: "#155724",

        cancelButtonColor: "grey",
        confirmButtonText: "Proceed!",
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
          Swal.fire({
            title: "Processing payment...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
              Swal.showLoading();
            },
          });
          let fd = new FormData();
          fd.append("payroll_id", payroll_id);
          fd.append("pin", result.value);
          axios
            .post("initialize_payment", fd)
            .then((response) => {
              console.log(response.data[0]);
              if (response.data[0] == "Invalid Pin") {
                Swal.fire("Incorrect Pin!", "Pin entered not correct", "error");
              } else if (response.data[0] == "Insufficient Fund") {
                Swal.fire(
                  "Insufficient Fund!",
                  "Kindly fund your wallet",
                  "error"
                );
              } else if (response.data[0].requestSuccessful) {
                Swal.fire(
                  "Payment Completed",
                  "Click on the check status button to check the status of each transaction",
                  "success"
                );
                this.new_payroll = response.data[1];
                this.checkStatusSecretly(payroll_id);
              } else {
                Swal.fire(
                  "Issue with payment",
                  "There is a little bit issue with payment",
                  "info"
                );
              }
            })
            .catch((error) => {
              console.log(error.message);
              Swal.fire(
                "Payment not processed",
                "There is an issue with the payment, please try again later",
                "error"
              );
            });
        }
      });
    },
    checkStatus(payroll_id) {
      Swal.fire({
        title: "Checking payment status...",
        onBeforeOpen: () => {
          Swal.showLoading();
        },
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
      });

      let fd = new FormData();
      fd.append("payroll_id", payroll_id);

      axios
        .post("check_payment_bulk_status", fd)
        .then((response) => {
          Swal.fire("Status confirmed");
          if (response.data[0] == 1) {
            this.check_pay_status = 1;
          } else {
            this.check_pay_status = 2;
          }
          this.new_payroll = response.data[1];

          this.dataTable.DataTable().destroy();
          this.change_pay = true;
          this.pick_first = "All";
        })
        .catch((error) => {
          console.log(error.message);
          Swal.fire(
            "Status checking failed",
            "There is an issue while checking the status of transaction, please try again later",
            "error"
          );
        });
    },

    checkStatusSecretly(payroll_id) {
      let fd = new FormData();
      fd.append("payroll_id", payroll_id);

      axios
        .post("check_payment_bulk_status", fd)
        .then((response) => {
          if (response.data[0] == 1) {
            this.check_pay_status = 1;
          } else {
            this.check_pay_status = 2;
          }
          this.new_payroll = response.data[1];

          this.dataTable.DataTable().destroy();
          this.change_pay = true;
          this.pick_first = "All";
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    checkFailedAccount() {
      let fd = new FormData();
      fd.append("payroll_id", this.new_payroll.uuid);
      axios
        .post("check_failed_account", fd)
        .then((response) => {
          console.log(response.data);

          if (response.data == 1) {
            this.failedAccount = true
          } else{
            this.failedAccount = false
          }
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    deletePayroll(payroll_id) {
      // Do the swal confirm stuff
      Swal.fire({
        title: "Are you sure you want to delete?",
        text: "To confirm delete, type the title of the payroll you want to delete.",
        icon: "warning",
        input: "text",
        inputAttributes: {
          autocapitalize: "off",
        },
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "grey",
        confirmButtonText: "Yes, Delete!",
        preConfirm: (text) => {
          if (text === this.selectedValue) {
            // Make the request or perform some action
            return true;
          } else {
            Swal.showValidationMessage("Invalid Payroll Name");
          }
        },
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete("delete_payroll/" + payroll_id)
            .then((response) => {
              console.log(response);
              Swal.fire({
                icon: "success",
                title: "Payroll Deleted Successfully!",
                text: "Updating...",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
              }).then((result) => {
                location.reload();
              });
            })
            .catch((error) => {
              console.log(error.message);
              Swal.fire(
                "Failed!",
                "Unable to delete, try again later",
                "error"
              );
            });
        }
      });
    },
    changePaymentStatus(payee_id) {
      let fd = new FormData();
      fd.append("payee_id", payee_id);
      axios
        .post("change_payment_status", fd)
        .then((response) => {
          console.log(response.data);

          if (response.data.pay_status == 1) {
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });

            Toast.fire({
              icon: "success",
              title:
                response.data.account_name +
                " account enabled to receive payment",
            });
          } else {
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });

            Toast.fire({
              icon: "info",
              title:
                response.data.account_name +
                " account disabled from receiving payment",
            });
          }
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    checkPaymentStatus(reference) {
      let fd = new FormData();
      fd.append("reference", reference);
      axios
        .post("check_payment_status", fd)
        .then((response) => {
          Swal.fire(
            response.data[0].responseBody.transactionDescription,
            "",
            "info"
          );
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    changePayroll(event) {
      console.log(event.target.value);

      axios
        .get("change_payroll/" + event.target.value)
        .then((response) => {
          console.log(response.data);

          this.new_payroll = response.data;

          this.dataTable.DataTable().destroy();
          this.change_pay = true;
          this.pick_first = "All";

          // this.dataTable.DataTable();
          // datatable.clear().rows.add(this.new_payroll).draw();
        })
        .catch((error) => {
          console.log(error.message, "max error");
        });
    },
    updatePayrollTitle(event) {
      let fd = new FormData();
      fd.append("payroll_id", this.new_payroll.uuid);
      fd.append("title", this.new_payroll.title);

      axios
        .post("update_payroll_title", fd)
        .then((response) => {
          console.log(response.data);

          this.payrolls = response.data;

          this.edit_payroll_title = true;

          // this.dataTable.DataTable();
          // datatable.clear().rows.add(this.new_payroll).draw();
        })
        .catch((error) => {
          console.log(error.message, "max error");
        });
    },
    resetDefault(payroll_id) {
      Swal.fire({
        title:
          "Reseting to default will reset all failed, pending and successful payment",
        text: "Input your four(4) digit pin",
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
        confirmButtonColor: "#d33",
        cancelButtonColor: "grey",
        confirmButtonText: "Yes, Reset!",
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
          let fd = new FormData();
          fd.append("payroll_id", payroll_id);
          fd.append("pin", result.value);
          axios
            .post("reset_payroll", fd)
            .then((response) => {
              console.log(response.data);
              if (response.data == "Invalid Pin") {
                Swal.fire(
                  "Invalid Pin",
                  "Retype the pin again or reset pin",
                  "error"
                );
              } else {
                Swal.fire(
                  "Reset Successfully",
                  response.data.title + " reset to default",
                  "success"
                );

                this.new_payroll = response.data;

                this.dataTable.DataTable().destroy();
                this.change_pay = true;
                this.pick_first = "All";
              }
            })
            .catch((error) => {
              console.log(error.message, "max error");
            });
        } else if (result.isDismissed) {
          console.log("Cancel button was clicked");
          // Add any other code you want to execute here
        }
      });
    },
    initializeDataTable() {
      $(this.$refs.myTable).DataTable().destroy();
      this.dataTable = $(this.$refs.myTable);
      this.dataTable.DataTable({
        order: [[6, "asc"]],
      });
    },
    copyLink() {
      const input = this.$refs.myLink;
      input.select();
      document.execCommand("copy");
    },
    pickFirst(event) {
      console.log(event.target.value);
      axios
        .get("pick_first/" + this.new_payroll.uuid + "/" + event.target.value)
        .then((response) => {
          console.log(response.data);
          // this.$set(this, this.new_payroll, response.data)

          this.new_payroll.payee = response.data;
          this.dataTable.DataTable().destroy();
          this.change_pay = true;
          // $(".datatable").DataTable().destroy();
          // $(".datatable").DataTable();
        })
        .catch((error) => {
          console.log(error.message, "max error");
        });
    },
    generateLink(payroll_id) {
      Swal.fire({
        title: this.new_payroll.live
          ? "Disable Generated Link?"
          : "Generate Link For Payroll",
        text: this.new_payroll.live
          ? "This will make this payroll unavailable for others to add account details!"
          : "This will make this payroll available for others to add account details!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: this.new_payroll.live
          ? "Yes, de-activate!"
          : "Yes, Generate!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .get("live_toggle/" + payroll_id)
            .then((response) => {
              console.log(response.data);
              this.new_payroll = response.data;
              // this.$set(this, this.new_payroll, response.data)
              Swal.fire(
                this.new_payroll.live ? "Link Generated" : "Link Disabled!",
                this.new_payroll.live
                  ? ""
                  : "Copy link and share with your payee.",
                "success"
              );
            })
            .catch((error) => {
              console.log(error.message, "max error");
            });
        }
      });
    },
    payrollCharge() {
      axios
        .get("change_payroll_charge/" + this.new_payroll.uuid)
        .then((response) => {
          console.log(response.data);
          this.new_payroll = response.data;
          // this.$set(this, this.new_payroll, response.data)
          this.dataTable.DataTable().destroy();
          this.change_pay = true;
          this.pick_first = "All";
         
        })
        .catch((error) => {
          console.log(error.message, "max error");
        });
    },
  },
  watch: {
    data: function (newVal, oldVal) {
      // check if the data has actually changed
      if (newVal !== oldVal) {
      }
    },
  },
  mounted() {
    this.initializeDataTable();
    this.checkFailedAccount();
    if (this.check_pay_status == 2) {
      this.checkStatusSecretly(this.new_payroll.uuid);
    }
  },

  updated() {
    if (this.change_pay == true) {
      this.initializeDataTable();
      this.change_pay = false;
      this.checkFailedAccount();
    }
  },
};
</script>

<style>
</style>