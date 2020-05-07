<template>
  <div class="container-fluid" style="padding-top:5%;padding-bottom:10%;">
    <loading
      :active.sync="loadingPage"
      :can-cancel="false"
      :is-full-page="fullPage"
      :opacity="0.9"
      color="#f87a2b"
      loader="bars"
      background-color="#fff"
    ></loading>
    <div class="container-xl" style="margin-top:5%;padding-bottom:5%;">
      <div class="row flex-center">
        <div class="col-md-12">
          <div class="card shadow-lg bg-white" id="card-reservation">
            <div class="card-header" id="card-reservation">Reservation</div>
            <div class="card-body" id="card-reservation" v-show="!changePage">
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-3" style="margin-top:15px;padding:30px;margin-right:20x;">
                  <label class="container-ratio">
                    One Way
                    <input type="radio" name="radio" @click="showOneway" />
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="col-md-2" style="margin-top:15px;padding:30px;margin-right:20x;">
                  <label class="container-ratio">
                    Return
                    <input type="radio" name="radio" @click="showReturn" />
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Number of Passenger :</label>

<<<<<<< HEAD
                    <div>
                      &nbsp; &nbsp; &nbsp;
                      <button
                        class="btn fas fa-minus-circle"
                        style="color:#ED4337;"
                        @click="removePass(counter)"
                      ></button>
                      {{ passengers.length }}
                      <button
                        class="btn fas fa-plus-circle"
                        style="color:#4BB543;"
                        @click="addPass(counter)"
                      ></button>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Class :</label>
                    <multiselect
                      v-model="input.class"
                      :options="allClass"
                      :show-labels="false"
                      :searchable="true"
                      :multiple="false"
                      :close-on-select="true"
                      :clear-on-select="false"
                      placeholder="Choose Class"
                    ></multiselect>
                  </div>
                </div>
                <div class="col-md-1"></div>
              </div>
              <div class="row flex-center" v-show="back">
                <div class="col-md-4 mb-4">
                  <label>
                    From :
                    {{ this.calendar_from.selectedDate }}
                  </label>
                  <functional-calendar
                    class="calendar"
                    v-model="calendar_from"
                    :configs="calendarConfigs"
                  ></functional-calendar>
                </div>
                <div class="col-md-4 mb-4">
                  <label>
                    To :
                    {{ this.calendar_to.selectedDate }}
                  </label>
                  <functional-calendar
                    class="calendar"
                    v-model="calendar_to"
                    :configs="calendarConfigs"
                  ></functional-calendar>
                </div>
              </div>
              <div class="row flex-center" v-show="oneway">
                <div class="col-md-4 mb-4">
                  <label>
                    Date :
                    {{ this.calendar_from.selectedDate }}
                  </label>
                  <functional-calendar
                    class="calendar"
                    v-model="calendar_from"
                    :configs="calendarConfigs"
                  ></functional-calendar>
                </div>
              </div>
              <hr class="mb-4" />
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Depart Flight No :</label>
                    <span class="input-text">
                      <br />From :
                    </span>
                    <multiselect
                      label="name"
                      openDirection="bottom"
                      v-model="input.flightFrom"
                      :options="airports"
                      :show-labels="false"
                      :searchable="true"
                      :multiple="false"
                      :close-on-select="true"
                      :clear-on-select="false"
                      placeholder="Choose Flight"
                    ></multiselect>
                    <div class="invalid-feedback">{{ error_flightFrom }}</div>
                  </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group">
                    <label>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀</label>
                    <span class="input-text">
                      <br />To :
                    </span>
                    <multiselect
                      label="name"
                      openDirection="bottom"
                      v-model="input.flightTo"
                      :options="airports"
                      :show-labels="false"
                      :searchable="true"
                      :multiple="false"
                      :close-on-select="true"
                      :clear-on-select="false"
                      placeholder="Choose Class"
                    ></multiselect>
                    <div class="invalid-feedback">{{ error_flightTo }}</div>
                  </div>
                </div>
                <div class="col-md-1"></div>
              </div>
              <br />
              <div class="row" v-show="back">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Return Flight No :</label>
                    <span class="input-text">
                      <br />From :
                    </span>
                    <multiselect
                      disabled
                      v-model="input.flightTo.name"
                      :options="airports"
                      :show-labels="false"
                      :searchable="true"
                      :multiple="false"
                      :close-on-select="true"
                      :clear-on-select="false"
                      placeholder="Choose Flight"
                    ></multiselect>
                    <div class="invalid-feedback">{{ error_flightFrom }}</div>
                  </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group">
                    <label>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀</label>
                    <span class="input-text">
                      <br />To :
                    </span>
                    <multiselect
                      disabled
                      v-model="input.flightFrom.name"
                      :options="airports"
                      :show-labels="false"
                      :searchable="true"
                      :multiple="false"
                      :close-on-select="true"
                      :clear-on-select="false"
                      placeholder="Choose Class"
                    ></multiselect>
                    <div class="invalid-feedback">{{ error_flightTo }}</div>
                  </div>
                </div>
                <div class="col-md-1"></div>
              </div>
              <hr class="mb-4" />
              <div
                v-show="queryFlight.length"
                class="container-xl"
                style="margin-top:2%;margin-bottom:10%"
              >
                <div class="row-reservation">
                  <div class="column-reservation" v-for="(showFlight, i) in queryFlight" :key="i">
                    {{ isActive === i }}
                    <div
                      class="card-reser"
                      :style="
=======
                                        <div>
                                            &nbsp; &nbsp; &nbsp;
                                            <button
                                                disabled
                                                v-if="passengers.length == 1"
                                                class=" btn fas fa-minus-circle"
                                                style="visibility: hidden;"
                                            ></button>
                                            <button
                                                v-if="passengers.length > 1"
                                                class=" btn fas fa-minus-circle"
                                                style="color:#ED4337;"
                                                @click="removePass(counter)"
                                            ></button>
                                            {{ passengers.length }}
                                            <button
                                                v-if="passengers.length < 10"
                                                class="btn fas fa-plus-circle"
                                                style="color:#4BB543;"
                                                @click="addPass(counter)"
                                            ></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Class :</label>
                                        <multiselect
                                            v-model="input.class"
                                            :options="allClass"
                                            :show-labels="false"
                                            :searchable="true"
                                            :multiple="false"
                                            :close-on-select="true"
                                            :clear-on-select="false"
                                            placeholder="Choose Class"
                                        ></multiselect>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="row flex-center" v-show="back">
                                <div class="col-md-4 mb-4">
                                    <label>
                                        From :
                                        {{ this.calendar_from.selectedDate }}
                                    </label>
                                    <functional-calendar
                                        class="calendar"
                                        v-model="calendar_from"
                                        :configs="calendarConfigs"
                                    ></functional-calendar>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label>
                                        To :
                                        {{ this.calendar_to.selectedDate }}
                                    </label>
                                    <functional-calendar
                                        class="calendar"
                                        v-model="calendar_to"
                                        :configs="calendarConfigs"
                                    ></functional-calendar>
                                </div>
                            </div>
                            <div class="row flex-center" v-show="oneway">
                                <div class="col-md-4 mb-4">
                                    <label>
                                        Date :
                                        {{ this.calendar_from.selectedDate }}
                                    </label>
                                    <functional-calendar
                                        class="calendar"
                                        v-model="calendar_from"
                                        :configs="calendarConfigs"
                                    ></functional-calendar>
                                </div>
                            </div>
                            <hr class="mb-4" />
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label> Depart Flight No :</label>
                                        <span class="input-text">
                                            <br />From :
                                        </span>
                                        <multiselect
                                            label="name"
                                            openDirection="bottom"
                                            v-model="input.flightFrom"
                                            :options="airports"
                                            :show-labels="false"
                                            :searchable="true"
                                            :multiple="false"
                                            :close-on-select="true"
                                            :clear-on-select="false"
                                            placeholder="Choose Flight"
                                        ></multiselect>
                                        <div class="invalid-feedback">
                                            {{ error_flightFrom }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀</label>
                                        <span class="input-text">
                                            <br />To :
                                        </span>
                                        <multiselect
                                            label="name"
                                            openDirection="bottom"
                                            v-model="input.flightTo"
                                            :options="airports"
                                            :show-labels="false"
                                            :searchable="true"
                                            :multiple="false"
                                            :close-on-select="true"
                                            :clear-on-select="false"
                                            placeholder="Choose Class"
                                        ></multiselect>
                                        <div class="invalid-feedback">
                                            {{ error_flightTo }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <br />
                            <div class="row" v-show="back">
                                <div class="col-md-1"></div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label> Return Flight No :</label>
                                        <span class="input-text">
                                            <br />From :
                                        </span>
                                        <multiselect
                                            label="name"
                                            disabled
                                            v-model="input.flightTo"
                                            :options="airports"
                                            :show-labels="false"
                                            :searchable="true"
                                            :multiple="false"
                                            :close-on-select="true"
                                            :clear-on-select="false"
                                            placeholder="Choose Flight"
                                        ></multiselect>
                                        <div class="invalid-feedback">
                                            {{ error_flightFrom }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀</label>
                                        <span class="input-text">
                                            <br />To :
                                        </span>
                                        <multiselect
                                            label="name"
                                            disabled
                                            v-model="input.flightFrom"
                                            :options="airports"
                                            :show-labels="false"
                                            :searchable="true"
                                            :multiple="false"
                                            :close-on-select="true"
                                            :clear-on-select="false"
                                            placeholder="Choose Class"
                                        ></multiselect>
                                        <div class="invalid-feedback">
                                            {{ error_flightTo }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>

                            <div
                                v-show="queryFlight.length"
                                class="container-xl"
                                style="margin-top:2%;margin-bottom:10%"
                            >
                                <h1>Depart</h1>
                                <hr class="mb-4" />
                                <div class="row-reservation">
                                    <div
                                        class="column-reservation"
                                        v-for="(showFlight, i) in queryFlight"
                                        :key="i"
                                    >
                                        <div
                                            class="card-reser"
                                            :style="
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
                                                isActive === i
                                                    ? {
                                                          'background-color':
                                                              '#2197e6'
                                                      }
                                                    : null
                                            "
                    >
                      <div class="row ml-2">
                        <div class="col-md-4">
                          <div class="row">
                            <h5>Flight No:</h5>&nbsp;
                            <h4>
                              <b>
                                {{
                                showFlight.flight_no
                                }}
                              </b>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="row ml-4">
                        <div class="col-md-4">
                          <div class="row">
                            <h3>
                              <b>
                                {{
                                showFlight.depart_location
                                }}
                              </b>
                            </h3>
                            <b>
                              &nbsp;
                              <i class="fas fa-plane"></i>
                              &nbsp;
                            </b>
                            <h3>
                              <b>
                                {{
                                showFlight.arrive_location
                                }}
                              </b>
                            </h3>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="row">
                            <h3>
                              <b>
                                {{
                                showFlight.depart_datetime.split(
                                " "
                                )[1]
                                }}
                              </b>
                            </h3>
                            <b>
                              &nbsp;
                              <i class="far fa-window-minimize"></i>&nbsp;
                            </b>
                            <h3>
                              <b>
                                {{
                                showFlight.arrive_datetime.split(
                                " "
                                )[1]
                                }}
                              </b>
                            </h3>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div
                            v-if="
                                                            input.class ==
                                                                'Economy'
                                                        "
                          >
                            <div class="row float-right mb-4">
                              <h1>
                                <b>
                                  {{
                                  showFlight.eco_price
                                  }}฿
                                </b>
                              </h1>
                            </div>
                          </div>
                          <div
                            v-if="
                                                            input.class ==
                                                                'Business'
                                                        "
                          >
                            <div class="row float-right mb-4">
                              <h1>
                                <b>
                                  {{
                                  showFlight.bus_price
                                  }}฿
                                </b>
                              </h1>
                            </div>
                          </div>
                          <div
                            v-if="
                                                            input.class ==
                                                                'First'
                                                        "
                          >
                            <div class="row float-right mb-4">
                              <h1>
                                <b>
                                  {{
                                  showFlight.first_price
                                  }}฿
                                </b>
                              </h1>
                            </div>
                          </div>
                        </div>
                      </div>

                      <button
                        id="btn-selected"
                        :style="
                                                    isActive === i
                                                        ? {
                                                              'background-color':
                                                                  '#f1ad2f'
                                                          }
                                                        : null
                                                "
                        :class="[
                                                    'btn btn-block',
                                                    {
                                                        selected:
                                                            showFlight.selected
                                                    },
                                                    {
                                                        active: isActive === i
                                                    }
                                                ]"
                        @click="
                                                    departSelected(
                                                        showFlight,
                                                        i
                                                    )
                                                "
                      >
                        <span v-show="isActive !== i">Select</span>
                        <span v-show="isActive === i">
                          <b>Selected</b>
                        </span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="mb-4" />
              <div
                v-show="queryReturnFlight.length && back"
                class="container-xl"
                style="margin-top:2%;margin-bottom:10%"
              >
                <div class="row-reservation">
                  <div
                    class="column-reservation"
                    v-for="(showFlight,
                                        i) in queryReturnFlight"
                    :key="'a' + i"
                  >
                    {{ isActive === i }}
                    <div
                      class="card-reser"
                      :style="
                                                isActive === i
                                                    ? {
                                                          'background-color':
                                                              '#f79c65'
                                                      }
                                                    : null
                                            "
                    >
                      <div class="row ml-2">
                        <div class="col-md-4">
                          <div class="row">
                            <h5>Flight No:</h5>&nbsp;
                            <h4>
                              <b>
                                {{
                                showFlight.flight_no
                                }}
                              </b>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="row ml-4">
                        <div class="col-md-4">
                          <div class="row">
                            <h3>
                              <b>
                                {{
                                showFlight.depart_location
                                }}
                              </b>
                            </h3>
                            <b>
                              &nbsp;
                              <i class="fas fa-plane"></i>
                              &nbsp;
                            </b>
                            <h3>
                              <b>
                                {{
                                showFlight.arrive_location
                                }}
                              </b>
                            </h3>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="row">
                            <h3>
                              <b>
                                {{
                                showFlight.depart_datetime.split(
                                " "
                                )[1]
                                }}
                              </b>
                            </h3>
                            <b>
                              &nbsp;
                              <i class="far fa-window-minimize"></i>&nbsp;
                            </b>
                            <h3>
                              <b>
                                {{
                                showFlight.arrive_datetime.split(
                                " "
                                )[1]
                                }}
                              </b>
                            </h3>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div
                            v-if="
                                                            input.class ==
                                                                'Economy'
                                                        "
                          >
                            <div class="row float-right mb-4">
                              <h1>
                                <b>
                                  {{
                                  showFlight.eco_price
                                  }}฿
                                </b>
                              </h1>
                            </div>
                          </div>
                          <div
                            v-if="
                                                            input.class ==
                                                                'Business'
                                                        "
                          >
                            <div class="row float-right mb-4">
                              <h1>
                                <b>
                                  {{
                                  showFlight.bus_price
                                  }}฿
                                </b>
                              </h1>
                            </div>
<<<<<<< HEAD
                          </div>
                          <div
                            v-if="
                                                            input.class ==
                                                                'First'
                                                        "
                          >
                            <div class="row float-right mb-4">
                              <h1>
                                <b>
                                  {{
                                  showFlight.first_price
                                  }}฿
                                </b>
                              </h1>
                            </div>
                          </div>
=======

                            <div
                                v-show="back && queryReturnFlight.length"
                                class="container-xl"
                                style="margin-top:2%;margin-bottom:10%"
                            >
                                <h1>Return</h1>
                                <hr class="mb-4" />
                                <div class="row-reservation">
                                    <div
                                        class="column-reservation"
                                        v-for="(showReturnFlight,
                                        k) in queryReturnFlight"
                                        :key="'a' + k"
                                    >
                                        <div
                                            class="card-reser"
                                            :style="
                                                isReturnActive === 'a' + k
                                                    ? {
                                                          'background-color':
                                                              '#2197e6'
                                                      }
                                                    : null
                                            "
                                        >
                                            <div class="row ml-2">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <h5>
                                                            Flight No:
                                                        </h5>
                                                        &nbsp;
                                                        <h4>
                                                            <b>{{
                                                                showReturnFlight.flight_no
                                                            }}</b>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ml-4">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <h3>
                                                            <b>{{
                                                                showReturnFlight.depart_location
                                                            }}</b>
                                                        </h3>
                                                        <b
                                                            >&nbsp;
                                                            <i
                                                                class="fas fa-plane"
                                                            ></i>
                                                            &nbsp;</b
                                                        >
                                                        <h3>
                                                            <b>{{
                                                                showReturnFlight.arrive_location
                                                            }}</b>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <h3>
                                                            <b>{{
                                                                showReturnFlight.depart_datetime.split(
                                                                    " "
                                                                )[1]
                                                            }}</b>
                                                        </h3>
                                                        <b
                                                            >&nbsp;
                                                            <i
                                                                class="far fa-window-minimize"
                                                            ></i
                                                            >&nbsp;</b
                                                        >
                                                        <h3>
                                                            <b>{{
                                                                showReturnFlight.arrive_datetime.split(
                                                                    " "
                                                                )[1]
                                                            }}</b>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 ">
                                                    <div
                                                        v-if="
                                                            input.class ==
                                                                'Economy'
                                                        "
                                                    >
                                                        <div
                                                            class="row float-right mb-4"
                                                        >
                                                            <h1>
                                                                <b
                                                                    >{{
                                                                        showReturnFlight.eco_price
                                                                    }}฿
                                                                </b>
                                                            </h1>
                                                        </div>
                                                    </div>
                                                    <div
                                                        v-if="
                                                            input.class ==
                                                                'Business'
                                                        "
                                                    >
                                                        <div
                                                            class="row float-right mb-4"
                                                        >
                                                            <h1>
                                                                <b
                                                                    >{{
                                                                        showReturnFlight.bus_price
                                                                    }}฿
                                                                </b>
                                                            </h1>
                                                        </div>
                                                    </div>
                                                    <div
                                                        v-if="
                                                            input.class ==
                                                                'First'
                                                        "
                                                    >
                                                        <div
                                                            class="row float-right mb-4"
                                                        >
                                                            <h1>
                                                                <b
                                                                    >{{
                                                                        showReturnFlight.first_price
                                                                    }}฿
                                                                </b>
                                                            </h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button
                                                id="btn-selected"
                                                :style="
                                                    isReturnActive === 'a' + k
                                                        ? {
                                                              'background-color':
                                                                  '#f1ad2f'
                                                          }
                                                        : null
                                                "
                                                :class="[
                                                    'btn btn-block',
                                                    {
                                                        selected:
                                                            showReturnFlight.selected
                                                    },
                                                    {
                                                        active:
                                                            isReturnActive ===
                                                            'a' + k
                                                    }
                                                ]"
                                                @click="
                                                    returnSelected(
                                                        showReturnFlight,
                                                        'a' + k
                                                    )
                                                "
                                            >
                                                <span
                                                    v-show="
                                                        isReturnActive !==
                                                            'a' + k
                                                    "
                                                    >Select</span
                                                >
                                                <span
                                                    v-show="
                                                        isReturnActive ===
                                                            'a' + k
                                                    "
                                                    ><b>Selected</b></span
                                                >
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
                        </div>
                      </div>

                      <button
                        id="btn-selected"
                        :style="
                                                    isActive === i
                                                        ? {
                                                              'background-color':
                                                                  '#2197e6'
                                                          }
                                                        : null
                                                "
                        :class="[
                                                    'btn btn-block',
                                                    {
                                                        selected:
                                                            showFlight.selected
                                                    },
                                                    {
                                                        active: isActive === i
                                                    }
                                                ]"
                        @click="
                                                    departSelected(
                                                        showFlight,
                                                        i
                                                    )
                                                "
                      >
                        <span v-show="isActive !== i">Select</span>
                        <span v-show="isActive === i">
                          <b>Selected</b>
                        </span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- page 2 -->
            <!-- page 2 -->
            <!-- page 2 -->
            <!-- page 2 -->
            <!-- page 2 -->
            <!-- page 2 -->
            <!-- page 2 -->
            <!-- page 2 -->
            <!-- page 2 -->

            <div class="card-body" id="card-reservation" v-show="changePage">
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <div class="container-xl" v-show="oneway">
                <div class="col-md-12">
                  <div class="plane">
                    <div class="cockpit">
                      <h1 style="margin-top:90px;">Please select a seat</h1>
                    </div>
                    <div class="exit exit--front fuselage"></div>

                    <ol class="cabin fuselage">
                      <h4 class="flex-center">First Class</h4>
                      <ol class="seats flex-center" v-for="(seatt, i) in firsts" :key="i">
                        <li class="seat" v-for="(f, k) in seatt" :key="k">
                          <div v-show="!f.patt == true">
                            <input
                              style="padding:5px;"
                              :value="f"
                              :id="f.id"
                              :disabled="
                                                                f.status == true
                                                            "
                              type="checkbox"
                              v-model="seats"
                            />
                            <label
                              style="padding:5px; color:#fff; font-size:10px"
                              :for="f.id"
                            >{{ f.seat }}</label>
                          </div>
                        </li>
                      </ol>
                      <div class="toliet toliet--back fuselage"></div>

                      <!-- busss -->
                      <h4 class="flex-center">Business Class</h4>
                      <ol class="seats flex-center" v-for="(seatt, i) in buss" :key="'a' + i">
                        <li class="seat" v-for="(f, k) in seatt" :key="'b' + k">
                          <div v-show="!f.patt == true">
                            <input
                              style="padding:5px;"
                              :value="f"
                              :id="f.id"
                              :disabled="
                                                                f.status == true
                                                            "
                              type="checkbox"
                              v-model="seats"
                            />
                            <label
                              style="padding:5px; color:#fff; font-size:10px"
                              :for="f.id"
                            >{{ f.seat }}</label>
                          </div>
                        </li>
                      </ol>
                      <div class="toliet toliet--back fuselage"></div>

                      <!-- ecooooo -->
                      <h4 class="flex-center">Economy Class</h4>
                      <ol class="seats flex-center" v-for="(eco, e) in ecos" :key="'c' + e">
                        <li class="seat" v-for="(index, p) in eco" :key="'d' + p">
                          <div
                            v-show="
                                                            !index.patt == true
                                                        "
                          >
                            <input
                              style="padding:5px;"
                              :value="index"
                              :id="index.id"
                              :disabled="
                                                                index.status ==
                                                                    true
                                                            "
                              type="checkbox"
                              v-model="seats"
                            />
                            <label style="padding:5px; color:#fff; font-size:10px" :for="index.id">
                              {{
                              index.seat
                              }}
                            </label>
                          </div>
                        </li>
                      </ol>
                      <div class="toliet toliet--back"></div>
                    </ol>

                    <div class="exit exit--back fuselage"></div>
                  </div>
                </div>
              </div>
              <!-- withreturn -->
              <!-- with return -->
              <div class="container-xl" v-show="back">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="plane">
                        <div class="cockpit">
                          <h1 style="margin-top:90px;">
                            plaese select depart
                            seat
                          </h1>
                        </div>
                        <div class="exit exit--front fuselage"></div>

                        <ol class="cabin fuselage">
                          <h4 class="flex-center">First Class</h4>
                          <ol
                            class="seats flex-center"
                            v-for="(seatt,
                                                        i) in firsts"
                            :key="i"
                          >
                            <li
                              class="seat"
                              v-for="(f,
                                                            k) in seatt"
                              :key="k"
                            >
                              <div
                                v-show="
                                                                    !f.patt ==
                                                                        true
                                                                "
                              >
                                <input
                                  style="padding:5px;"
                                  :value="f"
                                  :id="f.id"
                                  :disabled="
                                                                        f.status ==
                                                                            true
                                                                    "
                                  type="checkbox"
                                  v-model="
                                                                        seats
                                                                    "
                                />
                                <label style="padding:5px; color:#fff; font-size:10px" :for="f.id">
                                  {{
                                  f.seat
                                  }}
                                </label>
                              </div>
                            </li>
                          </ol>
                          <div class="toliet toliet--back fuselage"></div>

                          <!-- busss -->
                          <h4 class="flex-center">Business Class</h4>
                          <ol
                            class="seats flex-center"
                            v-for="(seatt,
                                                        i) in buss"
                            :key="'a' + i"
                          >
                            <li
                              class="seat"
                              v-for="(f,
                                                            k) in seatt"
                              :key="'b' + k"
                            >
                              <div
                                v-show="
                                                                    !f.patt ==
                                                                        true
                                                                "
                              >
                                <input
                                  style="padding:5px;"
                                  :value="f"
                                  :id="f.id"
                                  :disabled="
                                                                        f.status ==
                                                                            true
                                                                    "
                                  type="checkbox"
                                  v-model="
                                                                        seats
                                                                    "
                                />
                                <label style="padding:5px; color:#fff; font-size:10px" :for="f.id">
                                  {{
                                  f.seat
                                  }}
                                </label>
                              </div>
                            </li>
                          </ol>
                          <div class="toliet toliet--back fuselage"></div>

                          <!-- ecooooo -->
                          <h4 class="flex-center">Economy Class</h4>
                          <ol class="seats flex-center" v-for="(eco, e) in ecos" :key="'c' + e">
                            <li
                              class="seat"
                              v-for="(index,
                                                            p) in eco"
                              :key="'d' + p"
                            >
                              <div
                                v-show="
                                                                    !index.patt ==
                                                                        true
                                                                "
                              >
                                <input
                                  style="padding:5px;"
                                  :value="
                                                                        index
                                                                    "
                                  :id="
                                                                        index.id
                                                                    "
                                  :disabled="
                                                                        index.status ==
                                                                            true
                                                                    "
                                  type="checkbox"
                                  v-model="
                                                                        seats
                                                                    "
                                />
                                <label
                                  style="padding:5px; color:#fff; font-size:10px"
                                  :for="
                                                                        index.id
                                                                    "
                                >
                                  {{
                                  index.seat
                                  }}
                                </label>
                              </div>
                            </li>
                          </ol>
                          <div class="toliet toliet--back"></div>
                        </ol>

                        <div class="exit exit--back fuselage"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="plane">
                        <div class="cockpit">
                          <h1 style="margin-top:90px;">
                            plaese select return
                            seat
                          </h1>
                        </div>
                        <div class="exit exit--front fuselage"></div>

                        <ol class="cabin fuselage">
                          <h4 class="flex-center">First Class</h4>
                          <ol
                            class="seats flex-center"
                            v-for="(seatt,
                                                        i) in firsts2"
                            :key="i"
                          >
                            <li
                              class="seat"
                              v-for="(f,
                                                            k) in seatt"
                              :key="k"
                            >
                              <div
                                v-show="
                                                                    !f.patt ==
                                                                        true
                                                                "
                              >
                                <input
                                  style="padding:5px;"
                                  :value="f"
                                  :id="f.id"
                                  :disabled="
                                                                        f.status ==
                                                                            true
                                                                    "
                                  type="checkbox"
                                  v-model="
                                                                        seatReturn
                                                                    "
                                />
                                <label style="padding:5px; color:#fff; font-size:10px" :for="f.id">
                                  {{
                                  f.seat
                                  }}
                                </label>
                              </div>
                            </li>
                          </ol>
                          <div class="toliet toliet--back fuselage"></div>

                          <!-- busss -->
                          <h4 class="flex-center">Business Class</h4>
                          <ol
                            class="seats flex-center"
                            v-for="(seatt,
                                                        i) in buss2"
                            :key="'a' + i"
                          >
                            <li
                              class="seat"
                              v-for="(f,
                                                            k) in seatt"
                              :key="'b' + k"
                            >
                              <div
                                v-show="
                                                                    !f.patt ==
                                                                        true
                                                                "
                              >
                                <input
                                  style="padding:5px;"
                                  :value="f"
                                  :id="f.id"
                                  :disabled="
                                                                        f.status ==
                                                                            true
                                                                    "
                                  type="checkbox"
                                  v-model="
                                                                        seatReturn
                                                                    "
                                />
                                <label style="padding:5px; color:#fff; font-size:10px" :for="f.id">
                                  {{
                                  f.seat
                                  }}
                                </label>
                              </div>
                            </li>
                          </ol>
                          <div class="toliet toliet--back fuselage"></div>

<<<<<<< HEAD
                          <!-- ecooooo -->
                          <h4 class="flex-center flex-center">Economy Class</h4>
                          <ol
                            class="seats"
                            v-for="(eco,
=======
                                                    <!-- ecooooo -->
                                                    <h4 class="flex-center ">
                                                        Economy Class
                                                    </h4>
                                                    <ol
                                                        class="seats flex-center"
                                                        v-for="(eco,
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
                                                        e) in ecos2"
                            :key="'c' + e"
                          >
                            <li
                              class="seat"
                              v-for="(index,
                                                            p) in eco"
                              :key="'d' + p"
                            >
                              <div
                                v-show="
                                                                    !index.patt ==
                                                                        true
                                                                "
                              >
                                <input
                                  style="padding:5px;"
                                  :value="
                                                                        index
                                                                    "
                                  :id="
                                                                        index.id
                                                                    "
                                  :disabled="
                                                                        index.status ==
                                                                            true
                                                                    "
                                  type="checkbox"
                                  v-model="
                                                                        seatReturn
                                                                    "
                                />
                                <label
                                  style="padding:5px; color:#fff; font-size:10px"
                                  :for="
                                                                        index.id
                                                                    "
                                >
                                  {{
                                  index.seat
                                  }}
                                </label>
                              </div>
                            </li>
                          </ol>
                          <div class="toliet toliet--back"></div>
                        </ol>

                        <div class="exit exit--back fuselage"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <!-- seat -->
              <hr class="mb-4" />
              <div class="row">
                <div class="col-md-12">
                  <div
                    class="form-group"
                    v-for="(passenger,
                                        counter) in passengers"
                    :key="counter"
                  >
                    <div class="row">
                      <div class="col-md-1"></div>
                      <div class="col-md-2">
                        <h5>
                          <br />
                          Passenger
                          {{ Number(counter) + 1 }} :
                        </h5>
                      </div>
                    </div>

<<<<<<< HEAD
                    <div class="row">
                      <div class="col-md-1"></div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>Title</label>
                          <multiselect
                            v-bind:class="{
                                                            'is-invalid': error_title
=======
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <multiselect
                                                        v-bind:class="{
                                                            'is-invalid':
                                                                passenger.error_title
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
                                                        }"
                            v-model="
                                                            passenger.title
                                                        "
                            :options="titles"
                            :searchable="false"
                            :show-labels="false"
                            :multiple="false"
                            :close-on-select="true"
                            :clear-on-select="false"
                            placeholder
                            :preselect-first="false"
                          ></multiselect>

<<<<<<< HEAD
                          <span class="invalid-feedback">{{ error_title }}</span>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Name :</label>
                          <input
                            v-bind:class="{
                                                            'is-invalid': error_name
                                                        }"
                            placeholder="อาหลีเฮีย"
                            type="text"
                            class="form-control"
                            name="name"
                            v-model="passenger.name"
                          />
                          <div class="invalid-feedback">{{ error_name }}</div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Surname :</label>
                          <input
                            v-bind:class="{
                                                            'is-invalid': error_surname
=======
                                                    <span
                                                        class="invalid-feedback"
                                                        >{{
                                                            passenger.error_title
                                                        }}</span
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Name :</label>
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid':
                                                                passenger.error_name
                                                        }"
                                                        placeholder="อาหลีเฮีย"
                                                        type="text"
                                                        class="form-control"
                                                        name="name"
                                                        v-model="passenger.name"
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{
                                                            passenger.error_name
                                                        }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Surname :</label>
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid':
                                                                passenger.error_surname
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
                                                        }"
                            placeholder="อาเฮียหลี"
                            type="text"
                            class="form-control"
                            name="surname"
                            v-model="
                                                            passenger.surname
                                                        "
<<<<<<< HEAD
                          />
                          <div class="invalid-feedback">{{ error_surname }}</div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="col-md-6 control-label" for="radios">Gender :</label>
                          <div class="col-md-12">
                            <label class="radio-inline" for="radios-0">
                              <input
                                type="radio"
                                id="radios-0"
                                v-model="
                                                                    passenger.gender
                                                                "
                                value="Male"
                              />
                              Male
                            </label>
                            <label class="radio-inline" for="radios-1">
                              <input
                                type="radio"
                                id="radios-1"
                                v-model="
                                                                    passenger.gender
                                                                "
                                value="Female"
                              />
                              Female
                            </label>
                            <label class="radio-inline" for="radios-2">
                              <input
                                type="radio"
                                id="radios-1"
                                v-model="
                                                                    passenger.gender
                                                                "
                                value="Other"
                              />
                              Other
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Date of Birth :</label>
                          <input
                            v-bind:class="{
                                                            'is-invalid': error_dob
                                                        }"
                            type="date"
                            class="form-control"
                            v-model="passenger.dob"
                          />
                          <div class="invalid-feedback">{{ error_dob }}</div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Nationality :</label>
                          <input
                            v-bind:class="{
                                                            'is-invalid': error_national
=======
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{
                                                            passenger.error_surname
                                                        }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label
                                                        class="col-md-6 control-label"
                                                        for="radios"
                                                        >Gender :</label
                                                    >
                                                    <div class="col-md-12">
                                                        <label
                                                            class="radio-inline"
                                                            for="radios-0"
                                                        >
                                                            <input
                                                                v-bind:class="{
                                                                    'is-invalid':
                                                                        passenger.error_gender
                                                                }"
                                                                type="radio"
                                                                id="radios-0"
                                                                v-model="
                                                                    passenger.gender
                                                                "
                                                                value="Male"
                                                            />
                                                            Male
                                                        </label>
                                                        <div
                                                            class="invalid-feedback"
                                                        >
                                                            {{
                                                                passenger.error_gender
                                                            }}
                                                        </div>
                                                        <label
                                                            class="radio-inline"
                                                            for="radios-1"
                                                        >
                                                            <input
                                                                v-bind:class="{
                                                                    'is-invalid':
                                                                        passenger.error_gender
                                                                }"
                                                                type="radio"
                                                                id="radios-1"
                                                                v-model="
                                                                    passenger.gender
                                                                "
                                                                value="Female"
                                                            />
                                                            Female
                                                        </label>
                                                    </div>
                                                    <span
                                                        class="invalid-feedback"
                                                    >
                                                        {{
                                                            passenger.error_gender
                                                        }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label
                                                        >Date of Birth :</label
                                                    >
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid':
                                                                passenger.error_dob
                                                        }"
                                                        type="date"
                                                        class="form-control"
                                                        v-model="passenger.dob"
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{
                                                            passenger.error_dob
                                                        }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Nationality :</label>
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid':
                                                                passenger.error_national
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
                                                        }"
                            class="form-control"
                            v-model="
                                                            passenger.national
                                                        "
<<<<<<< HEAD
                          />
                          <div class="invalid-feedback">{{ error_national }}</div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Religion :</label>
                          <input
                            v-bind:class="{
                                                            'is-invalid': error_religion
=======
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{
                                                            passenger.error_national
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Religion :</label>
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid':
                                                                passenger.error_religion
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
                                                        }"
                            class="form-control"
                            v-model="
                                                            passenger.religion
                                                        "
<<<<<<< HEAD
                          />
                          <div class="invalid-feedback">{{ error_religion }}</div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>ID card :</label>
                          <input
                            v-bind:class="{
                                                            'is-invalid': error_idcard
=======
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{
                                                            passenger.error_religion
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>ID card :</label>
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid':
                                                                passenger.error_idcard
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
                                                        }"
                            type="text"
                            class="form-control"
                            v-model="
                                                            passenger.idcard
                                                        "
<<<<<<< HEAD
                          />
                          <div class="invalid-feedback">{{ error_idcard }}</div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Passport :</label>
                          <input
                            v-bind:class="{
                                                            'is-invalid': error_passport
=======
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{
                                                            passenger.error_idcard
                                                        }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Passport :</label>
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid':
                                                                passenger.error_passport
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
                                                        }"
                            type="text"
                            class="form-control"
                            v-model="
                                                            passenger.passport
                                                        "
<<<<<<< HEAD
                          />
                          <div class="invalid-feedback">{{ error_passport }}</div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Phone Number :</label>
                          <input
                            v-bind:class="{
                                                            'is-invalid': error_phone
=======
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{
                                                            passenger.error_passport
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label
                                                        >Phone Number :</label
                                                    >
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid':
                                                                passenger.error_phone
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
                                                        }"
                            placeholder="098-7654321"
                            type="text"
                            class="form-control"
                            v-model="
                                                            passenger.phone
                                                        "
<<<<<<< HEAD
                          />
                          <div class="invalid-feedback">{{ error_phone }}</div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Email :</label>
                          <input
                            v-bind:class="{
                                                            'is-invalid': error_email
=======
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{
                                                            passenger.error_phone
                                                        }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Email :</label>
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid':
                                                                passenger.error_email
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
                                                        }"
                            placeholder="example@hotmail.com"
                            type="text"
                            class="form-control"
                            v-model="
                                                            passenger.email
                                                        "
<<<<<<< HEAD
                          />
                          <div class="invalid-feedback">{{ error_email }}</div>
                        </div>
                      </div>
                    </div>
                    <hr />
                  </div>
                </div>
              </div>
              <div class="row" style="padding:30px">
                <h4 style="margin-left:15px;">Payment :</h4>
                <br />
                <div class="container-xl">
                  <div class="row">
                    <div class="col-md-6">Total:</div>
                    <div class="col-md-6">
                      <label>Payment Methods :</label>
                      <multiselect
                        v-bind:class="{
                                                    'is-invalid': error_payMethod
                                                }"
                        v-model="payment.method"
                        :options="paymentMethod"
                        :searchable="false"
                        :show-labels="false"
                        :multiple="false"
                        :close-on-select="true"
                        :clear-on-select="false"
                        placeholder="Please select payment method"
                        :preselect-first="false"
                      ></multiselect>
                    </div>
                  </div>
                  <div class="row" v-show="payment.method == 'Credit Card'">
                    <div class="col-md-6"></div>
                    <div class="col-md-6 mt-2">
                      <label>Credit Card :</label>
                      <input
                        v-bind:class="{
                                                    'is-invalid': error_cardNumber
                                                }"
                        type="text"
                        class="form-control"
                        v-model="payment.cardNumber"
                      />
=======
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{
                                                            passenger.error_email
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding:30px">
                                <h4 style="margin-left:15px;">
                                    Payment :
                                </h4>
                                <br />
                                <br />
                                <div class="container-xl">
                                    <div class="row">
                                        <br />
                                        <div class="col-md-6 ">
                                            <div class="row float-right">
                                                <div class="col-md-12 ">
                                                    <h4>
                                                        Depart:
                                                        {{ this.depart_price }}
                                                        x
                                                        {{
                                                            this.no_of_passenger
                                                        }}
                                                        =
                                                        {{
                                                            Number(
                                                                this
                                                                    .depart_price
                                                            ) *
                                                                Number(
                                                                    this
                                                                        .no_of_passenger
                                                                )
                                                        }}
                                                        ฿
                                                    </h4>
                                                </div>
                                            </div>

                                            <br />
                                            <div
                                                class="row float-right"
                                                v-show="back"
                                            >
                                                <div class="col-md-12 ">
                                                    <h4>
                                                        Return:
                                                        {{ this.return_price }}
                                                        x
                                                        {{
                                                            this.no_of_passenger
                                                        }}
                                                        =
                                                        {{
                                                            Number(
                                                                this
                                                                    .return_price
                                                            ) *
                                                                Number(
                                                                    this
                                                                        .no_of_passenger
                                                                )
                                                        }}
                                                        ฿
                                                    </h4>
                                                </div>
                                            </div>
                                            <br />
                                            <br />
                                            <div class="row float-right">
                                                <div class="col-md-12 ">
                                                    <h3>
                                                        Total:
                                                        {{
                                                            Number(
                                                                this
                                                                    .depart_price
                                                            ) *
                                                                Number(
                                                                    this
                                                                        .no_of_passenger
                                                                ) +
                                                                Number(
                                                                    this
                                                                        .return_price
                                                                ) *
                                                                    Number(
                                                                        this
                                                                            .no_of_passenger
                                                                    )
                                                        }}
                                                        ฿
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Payment Methods :</label>
                                            <multiselect
                                                v-bind:class="{
                                                    'is-invalid': error_payMethod
                                                }"
                                                v-model="payment.method"
                                                :options="paymentMethod"
                                                :searchable="false"
                                                :show-labels="false"
                                                :multiple="false"
                                                :close-on-select="true"
                                                :clear-on-select="false"
                                                placeholder="Please select payment method"
                                                :preselect-first="false"
                                            ></multiselect>
                                            <div class="invalid-feedback">
                                                {{ error_payMethod }}
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="row"
                                        v-show="
                                            payment.method == 'VisaCard' ||
                                                payment.method == 'MasterCard'
                                        "
                                    >
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6 mt-2">
                                            <label>Credit Card :</label>
                                            <input
                                                v-bind:class="{
                                                    'is-invalid': error_cardNumber
                                                }"
                                                type="text"
                                                class="form-control"
                                                v-model="payment.cardNumber"
                                            />
                                            <div class="invalid-feedback">
                                                {{ error_cardNumber }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer ">
                            <div class="col-md-12">
                                <button
                                    v-if="!changePage"
                                    style="color:#fff"
                                    id="card-reservation"
                                    type="button"
                                    @click="handleChangePage"
                                    class="btn btn-block btn-login"
                                >
                                    Next
                                </button>
                            </div>
                            <div class="col-md-12">
                                <button
                                    v-if="changePage"
                                    style="color:#fff"
                                    id="card-reservation"
                                    type="submit"
                                    class="btn btn-block btn-info"
                                    @click="submit"
                                >
                                    <span v-show="!isLoading">Submit</span>
                                    <i
                                        class="fas fa-spinner fa-pulse"
                                        v-show="isLoading"
                                    ></i>
                                </button>
                                <button
                                    v-if="changePage"
                                    style="color:#fff"
                                    id="card-reservation"
                                    type="button"
                                    @click="handleChangePage"
                                    class="btn btn-block btn-success"
                                >
                                    Back
                                </button>
                            </div>
                        </div>
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer">
              <div class="col-md-12">
                <button
                  v-if="!changePage"
                  style="color:#fff"
                  id="card-reservation"
                  type="button"
                  @click="handleChangePage"
                  class="btn btn-block btn-login"
                >Next</button>
              </div>
              <div class="col-md-12">
                <button
                  v-if="changePage"
                  style="color:#fff"
                  id="card-reservation"
                  type="submit"
                  class="btn btn-block btn-info"
                >Submit</button>
                <button
                  v-if="changePage"
                  style="color:#fff"
                  id="card-reservation"
                  type="button"
                  @click="handleChangePage"
                  class="btn btn-block btn-success"
                >Back</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Multiselect from "vue-multiselect";
import { FunctionalCalendar } from "vue-functional-calendar";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
<<<<<<< HEAD
  components: { Multiselect, Loading, FunctionalCalendar },
  data() {
    return {
      firsts: [],
      buss: [],
      ecos: [],
      firsts2: [],
      buss2: [],
      ecos2: [],
      isSelected: false,
      isActive: null,
      activeColor: "",
      seats: [],
      seatReturn: [],
      queryFlight: [],
      queryReturnFlight: [],
      depart_Selected: null,
      return_Selected: null,
      oneway: false,
      back: false,
      loadingPage: false,
      fullPage: true,
      changePage: false,
      counter: "",
      airports: [],
      allClass: ["Economy", "Business", "First"],
      titles: ["Mr.", "Mrs.", "Ms.", "Miss"],
      calendar_from: {},
      calendar_to: {},
      calendarConfigs: {
        disabledDates: ["beforeToday"],
        isDatePicker: true
      },
      input: {
        class: "",
        departDate: "",
        returnDate: "",
        flightTo: "",
        flightFrom: ""
      },
      passengers: [
        {
          title: "",
          name: "",
          surname: "",
          gender: "",
          dob: "",
          national: "",
          idcard: "",
          passport: "",
          religion: "",
          phone: "",
          email: ""
        }
      ],
      payment: {
        method: "",
        cardNumber: "",
        total: ""
      },
      paymentMethod: ["Credit Card", "Cash"],

      error_departDate: "",
      error_returnDate: "",
      error_flightTo: "",
      error_flightFrom: "",
      error_flightTo2: "",
      error_flightFrom2: "",
      error_title: "",
      error_name: "",
      error_surname: "",
      error_gender: "",
      error_dob: "",
      error_national: "",
      error_idcard: "",
      error_passport: "",
      ///
      temp_back: null,
      temp_calendar_to: null,
      temp_calendar_from: null,
      temp_flightTo: null,
      temp_flightFrom: null,
      temp_class: null,
      temp_passenger: null,
      ///
      error_religion: "",
      error_phone: "",
      error_email: "",
      error_payMethod: "",
      error_cardNumber: ""
    };
  },
  beforeMount() {
    this.loadingPage = true;
    setTimeout(() => {
      this.loadingPage = false;
    }, 1000);

    axios.get("api/user/getLocation").then(response => {
      response.data.forEach(element => {
        this.airports.push({
          name:
            element["airport_id"] +
            " - " +
            element["airport_name"] +
            " [" +
            element["airport_region"] +
            "]",
          value: element
=======
    components: { Multiselect, Loading, FunctionalCalendar },
    data() {
        return {
            isLoading: false,
            D_already_seat: [],
            R_already_seat: [],
            firsts: [],
            buss: [],
            ecos: [],
            firsts2: [],
            buss2: [],
            ecos2: [],
            ///
            user_id: "",
            ///
            isReturnSelected: false,
            isSelected: false,
            isActive: null,
            isReturnActive: null,
            ///
            seats: [],
            seatReturn: [],
            check_Dseat: -1,
            check_Rseat: -1,
            //
            queryFlight: [],
            queryReturnFlight: [],
            depart_Selected: null,
            return_Selected: null,
            no_of_passenger: null,
            ///
            oneway: false,
            back: false,
            loadingPage: false,
            fullPage: true,
            changePage: false,
            counter: "",
            airports: [],
            allClass: ["Economy", "Business", "First"],
            titles: ["Mr.", "Mrs.", "Ms.", "Miss"],
            calendar_from: {},
            calendar_to: {},
            calendarConfigs: {
                disabledDates: ["beforeToday"],
                isDatePicker: true
            },
            input: {
                class: null,
                departDate: null,
                returnDate: null,
                flightTo: null,
                flightFrom: null
            },
            returnClass: "",
            passengers: [
                {
                    title: "",
                    name: "",
                    surname: "",
                    gender: "",
                    dob: "",
                    national: "",
                    idcard: "",
                    passport: "",
                    religion: "",
                    phone: "",
                    email: "",
                    error_title: "",
                    error_name: "",
                    error_surname: "",
                    error_gender: "",
                    error_dob: "",
                    error_national: "",
                    error_idcard: "",
                    error_passport: "",
                    error_religion: "",
                    error_phone: "",
                    error_email: ""
                }
            ],
            payment: {
                method: "",
                cardNumber: "",
                total: ""
            },
            paymentMethod: ["VisaCard", "MasterCard", "Cash"],
            depart_price: 0,
            return_price: 0,
            check_cal: true,

            error_departDate: "",
            error_returnDate: "",
            error_flightTo: "",
            error_flightFrom: "",
            error_flightTo2: "",
            error_flightFrom2: "",

            errors: [],
            ///
            temp_back: null,
            temp_calendar_to: null,
            temp_calendar_from: null,
            temp_flightTo: null,
            temp_flightFrom: null,
            temp_class: null,
            temp_passenger: null,
            ///

            error_payMethod: "",
            error_cardNumber: "",
            error_user: ""
        };
    },
    beforeMount() {
        this.loadingPage = true;
        axios.get("/sanctum/csrf-cookie").then(response => {
            axios.get("api/user").then(response => {
                this.user_id = response.data["user_id"];
                this.loadingPage = false;
            });
        });
        // setTimeout(() => {
        // }, 1000);
        axios.get("api/user/getLocation").then(response => {
            response.data.forEach(element => {
                this.airports.push({
                    name:
                        element["airport_id"] +
                        " - " +
                        element["airport_name"] +
                        " [" +
                        element["airport_region"] +
                        "]",
                    value: element
                });
            });
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
        });
      });
    });
  },

<<<<<<< HEAD
  methods: {
    handleChangePage() {
      if (this.isSelected) {
        if (!this.changePage) {
          this.loadingPage = true;
          setTimeout(() => {
            this.changePage = true;
            this.loadingPage = false;
          }, 1000);
        } else if (this.changePage) {
          this.loadingPage = false;
          swal
            .fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, change it!"
            })
            .then(result => {
              if (result.value) {
                this.loadingPage = true;
                setTimeout(() => {
                  this.loadingPage = false;
                  this.changePage = false;
                  this.isSelected = false;
                  this.isActive = null;
                }, 1000);
              } else {
                swal.fire(
                  "Cancelled",
                  "Status work date has not changed.",
                  "error"
                );
              }
            });
        }
      } else {
        swal
          .fire(
            "Please select flight!",
            "Cilck the button to continue!",
            "warning"
          )
          .then(() => {
            this.changePage = false;
          });
      }
    },
    departSelected(showFlight, index) {
      this.isSelected = showFlight.selected = true;
      this.isActive = index;

      this.depart_Selected = showFlight;
      console.log("selectedddd", this.depart_Selected);

      this.depart_Selected.class = this.input.class;

      axios.post("/api/user/checkSeat", this.depart_Selected).then(response => {
        console.log(response.data);

        this.firsts = response.data.firsts;
        this.buss = response.data.buss;
        this.ecos = response.data.ecos;
      });
    },
    showReturn() {
      this.back = true;
      this.oneway = false;
    },
    showOneway() {
      this.back = false;
      this.oneway = true;
    },

    addPass(index) {
      this.passengers.push({
        title: "",
        name: "",
        surname: "",
        gender: "",
        dob: "",
        national: "",
        idcard: "",
        passport: "",
        religion: "",
        phone: "",
        email: ""
      });
=======
    methods: {
        submit(e) {
            //console.log("depart seat", this.seats); // depart seat
            //console.log("return seat", this.seatReturn); // return seat
            // console.log("passengers", this.passengers); // passengers in carbin
            // console.log("payment detail", this.payment); // payment detail
            // console.log("flight depart", this.depart_Selected); // flight depart
            // console.log("flight return", this.return_Selected); // flight return
            // console.log("depart_price", this.depart_price);
            // console.log("return_price", this.return_price);
            // console.log("no_of_passenger", this.no_of_passenger) // number of passenger
            // console.log("class seat",this.input.class); // class seat
            // console.log("user_id",this.user_id);
            // console.log(this.passengers.length);

            e.preventDefault();
            this.errors = [];
            this.error_payMethod = null;
            this.error_cardNumber = null;

            for (var k = 0; k < this.no_of_passenger; k++) {
                this.passengers[k].error_title = null;
                this.passengers[k].error_name = null;
                this.passengers[k].error_surname = null;
                this.passengers[k].error_gender = null;
                this.passengers[k].error_dob = null;
                this.passengers[k].error_national = null;
                this.passengers[k].error_idcard = null;
                this.passengers[k].error_passport = null;
                this.passengers[k].error_religion = null;
                this.passengers[k].error_phone = null;
                this.passengers[k].error_email = null;
            }

            for (var i = 0; i < this.no_of_passenger; i++) {
                if (!this.passengers[i].title) {
                    this.passengers[i].error_title = "Please select title.";
                    this.errors.push(this.passengers[i].error_title);
                } else {
                    this.passengers[i].error_title = null;
                }

                if (!this.passengers[i].name) {
                    this.passengers[i].error_name = "Please enter name.";
                    this.errors.push(this.passengers[i].error_name);
                } else {
                    this.passengers[i].error_name = null;
                }

                if (!this.passengers[i].surname) {
                    this.passengers[i].error_surname = "Please enter name.";
                    this.errors.push(this.passengers[i].error_surname);
                } else {
                    this.passengers[i].error_surname = null;
                }

                if (!this.passengers[i].gender) {
                    this.passengers[i].error_gender = "Please enter gender.";
                    this.errors.push(this.passengers[i].error_gender);
                } else {
                    this.passengers[i].error_gender = null;
                }

                if (!this.passengers[i].dob) {
                    this.passengers[i].error_dob =
                        "Please enter Date of Birth.";
                    this.errors.push(this.passengers[i].error_dob);
                } else {
                    this.passengers[i].error_dob = null;
                }

                if (!this.passengers[i].national) {
                    this.passengers[i].error_national =
                        "Please enter nationality";
                    this.errors.push(this.passengers[i].error_national);
                } else {
                    this.passengers[i].error_national = null;
                }

                if (!this.passengers[i].idcard) {
                    if (!this.passengers[i].passport) {
                        this.passengers[i].error_idcard =
                            "Please enter idcard or passport";
                        this.passengers[i].error_passport =
                            "Please enter idcard or passport";
                        this.errors.push(this.passengers[i].error_idcard);
                        this.errors.push(this.passengers[i].error_passport);
                    } else if (this.passengers[i].passport.length != 13) {
                        this.passengers[i].error_passport =
                            "Password must be 13 characters.";
                        this.errors.push(this.passengers[i].error_passport);
                    } else if (isNaN(this.passengers[i].passport)) {
                        this.passengers[i].error_passport =
                            "Please fill only number.";
                        this.errors.push(this.passengers[i].error_passport);
                    } else {
                        this.passengers[i].error_passport = null;
                    }
                } else if (
                    this.passengers[i].passport &&
                    this.passengers[i].idcard
                ) {
                    this.passengers[i].error_idcard = "Please enter only one";
                    this.passengers[i].error_passport = "Please enter only one";
                    this.errors.push(this.passengers[i].error_idcard);
                    this.errors.push(this.passengers[i].error_passport);
                    this.passengers[i].passport = "";
                    this.passengers[i].idcard = "";
                } else if (this.passengers[i].idcard.length != 13) {
                    this.passengers[i].error_idcard =
                        "Password must be 13 characters.";
                    this.errors.push(this.passengers[i].error_idcard);
                } else if (isNaN(this.passengers[i].idcard)) {
                    this.passengers[i].error_idcard =
                        "Please fill only number.";
                    this.errors.push(this.passengers[i].error_idcard);
                } else {
                    this.passengers[i].error_idcard = null;
                }

                if (!this.passengers[i].religion) {
                    this.passengers[i].error_religion = "Please enter religion";
                    this.errors.push(this.passengers[i].error_religion);
                } else {
                    this.passengers[i].error_religion = null;
                }

                if (!this.passengers[i].email) {
                    this.passengers[i].error_email = "Please enter email";
                    this.errors.push(this.passengers[i].error_email);
                } else {
                    this.passengers[i].error_email = null;
                }

                if (!this.passengers[i].phone) {
                    this.passengers[i].error_phone =
                        "Please fill your phone number.";
                    this.errors.push(this.passengers[i].error_phone);
                } else if (isNaN(this.passengers[i].phone)) {
                    this.passengers[i].error_phone = "Please fill only number.";
                    this.errors.push(this.passengers[i].error_phone);
                } else if (this.passengers[i].phone.length != 10) {
                    this.passengers[i].error_phone =
                        "Phone number must be 10 characters.";
                    this.errors.push(this.passengers[i].error_phone);
                } else {
                    this.passengers[i].error_phone = null;
                }
            }

            if (!this.payment.method) {
                this.error_payMethod = "Please fill your payment method.";
                this.errors.push(this.error_payMethod);
            } else {
                if (
                    this.payment.method == "MasterCard" ||
                    this.payment.method == "VisaCard"
                ) {
                    if (!this.payment.cardNumber) {
                        this.error_cardNumber = "Please fill your card number.";
                        this.errors.push(this.error_cardNumber);
                    } else if (isNaN(this.payment.cardNumber)) {
                        this.error_cardNumber = "Please fill only number.";
                        this.errors.push(this.error_cardNumber);
                    } else if (this.payment.cardNumber.length != 16) {
                        this.error_cardNumber =
                            "Card number must be 16 characters.";
                        this.errors.push(this.error_cardNumber);
                    }
                } else {
                    this.error_cardNumber = null;
                }
                this.error_payMethod = null;
            }
            if (!this.errors.length) {
                if (
                    this.seats.length != this.no_of_passenger ||
                    (this.seats.length != this.no_of_passenger &&
                        this.seatReturn.length != this.no_of_passenger)
                ) {
                    swal.fire(
                        "please select seat",
                        "Cilck the button to continue!",
                        "warning"
                    ).then(() => {});
                } else {
                    let data = {
                        reserve_data: this.input,
                        user_id: this.user_id,
                        passenger: this.passengers,
                        seat_depart: this.seats,
                        seat_return: this.seatReturn,
                        payment_method: this.payment.method,
                        price:
                            this.depart_price * this.no_of_passenger +
                            this.return_price * this.no_of_passenger,
                        payment_card: this.payment.cardNumber,
                        flight: [this.depart_Selected, this.return_Selected]
                    };
                    axios
                        .post("api/user/reserveSendData", data)
                        .then(response => {
                            console.log(response.data);

                            swal.fire(
                                "Reservation Success!",
                                "Cilck the button to continue!",
                                "success"
                            ).then(() => {
                                // console.log("reservation", response.data);
                                this.loadingPage = true;
                                setTimeout(() => {
                                    this.loadingPage = false;
                                    this.changePage = false;
                                    this.isSelected = false;
                                    this.isReturnSelected = false;
                                    this.isActive = null;
                                    this.isReturnActive = null;
                                    this.$router.go({ name: "reservation" });
                                }, 1000);
                            });
                        })
                        .catch(error => {
                            swal.fire(
                                "error!",
                                "Cilck the button to continue!",
                                "error"
                            ).then(() => {});
                        });
                }
            }
        },
        handleChangePage() {
            if (this.back) {
                if (
                    this.isReturnSelected === true &&
                    this.isSelected === true
                ) {
                    if (!this.changePage) {
                        this.loadingPage = true;
                        setTimeout(() => {
                            this.seats = [];
                            this.seatReturn = [];
                            this.changePage = true;
                            this.loadingPage = false;
                        }, 1000);
                    } else if (this.changePage === true) {
                        this.loadingPage = false;
                        swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, change it!"
                        }).then(result => {
                            if (result.value) {
                                this.loadingPage = true;
                                setTimeout(() => {
                                    this.loadingPage = false;
                                    this.changePage = false;
                                    this.isSelected = false;
                                    this.isReturnSelected = false;
                                    this.isActive = null;
                                    this.isReturnActive = null;
                                }, 1000);
                            } else {
                                swal.fire(
                                    "Cancelled",
                                    "Status work date has not changed.",
                                    "error"
                                );
                            }
                        });
                    }
                } else if (
                    this.isReturnSelected === true &&
                    this.isSelected === false
                ) {
                    swal.fire(
                        "Please select depart flight!",
                        "Cilck the button to continue!",
                        "warning"
                    ).then(() => {
                        this.changePage = false;
                    });
                } else if (
                    this.isReturnSelected === false &&
                    this.isSelected === true
                ) {
                    swal.fire(
                        "Please select return flight!",
                        "Cilck the button to continue!",
                        "warning"
                    ).then(() => {
                        this.changePage = false;
                    });
                } else {
                    swal.fire(
                        "Please select depart and return flight",
                        "Cilck the button to continue!",
                        "warning"
                    ).then(() => {
                        this.changePage = false;
                    });
                }
            } else if (this.isSelected === true) {
                if (!this.changePage) {
                    this.loadingPage = true;
                    setTimeout(() => {
                        this.seats = [];
                        this.seatReturn = [];
                        this.changePage = true;
                        this.loadingPage = false;
                    }, 1000);
                } else if (this.changePage === true) {
                    this.loadingPage = false;
                    swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, change it!"
                    }).then(result => {
                        if (result.value) {
                            this.loadingPage = true;
                            setTimeout(() => {
                                this.loadingPage = false;
                                this.changePage = false;
                                this.isSelected = false;
                                this.isActive = null;
                            }, 1000);
                        } else {
                            swal.fire(
                                "Cancelled",
                                "Status work date has not changed.",
                                "error"
                            );
                        }
                    });
                } else {
                    swal.fire(
                        "Please select flight!",
                        "Cilck the button to continue!",
                        "warning"
                    ).then(() => {
                        this.changePage = false;
                    });
                }
            } else {
                swal.fire(
                    "Please success form before click next",
                    "Cilck the button to continue!",
                    "warning"
                ).then(() => {
                    this.changePage = false;
                });
            }
        },
        returnSelected(showReturnFlight, index) {
            this.isReturnSelected = showReturnFlight.selected = true;
            this.isReturnActive = index;

            this.return_Selected = showReturnFlight;
            this.return_Selected.class = this.input.class;
            this.depart_Selected.type = "R";

            axios
                .post("/api/user/checkSeat", this.return_Selected)
                .then(response => {
                    this.firsts2 = response.data.firsts;
                    this.buss2 = response.data.buss;
                    this.ecos2 = response.data.ecos;
                    this.R_already_seat = response.data.already_seat;
                });
        },
        departSelected(showFlight, index) {
            this.isSelected = showFlight.selected = true;
            this.isActive = index;

            this.depart_Selected = showFlight;
            this.depart_Selected.class = this.input.class;
            this.depart_Selected.type = "D";

            axios
                .post("/api/user/checkSeat", this.depart_Selected)
                .then(response => {
                    this.firsts = response.data.firsts;
                    this.buss = response.data.buss;
                    this.ecos = response.data.ecos;
                    this.D_already_seat = response.data.already_seat;
                });
        },
        showReturn() {
            this.back = true;
            this.oneway = false;
            this.isSelected = false;
            this.isReturnSelected = false;
            this.isActive = null;
            this.isReturnActive = null;
            this.seats = [];
            this.seatReturn = [];
        },
        showOneway() {
            this.back = false;
            this.oneway = true;
            this.isSelected = false;
            this.isReturnSelected = false;
            this.isActive = null;
            this.isReturnActive = null;
            this.seats = [];
            this.seatReturn = [];
        },

        addPass(index) {
            this.passengers.push({
                title: "",
                name: "",
                surname: "",
                gender: "",
                dob: "",
                national: "",
                idcard: "",
                passport: "",
                religion: "",
                phone: "",
                email: "",
                error_title: "",
                error_name: "",
                error_surname: "",
                error_gender: "",
                error_dob: "",
                error_national: "",
                error_idcard: "",
                error_passport: "",
                error_religion: "",
                error_phone: "",
                error_email: ""
            });
        },
        removePass(index) {
            this.passengers.splice(index, 1);
        }
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
    },
    removePass(index) {
      this.passengers.splice(index, 1);
    }
  },

<<<<<<< HEAD
  beforeUpdate() {
    if (
      (!this.back || !(this.back ^ !!this.calendar_to.selectedDate)) &&
      !!this.calendar_from.selectedDate &&
      !!this.input.flightTo &&
      !!this.input.flightFrom &&
      !!this.input.class &&
      (this.temp_back != this.back ||
        this.temp_calendar_to != this.calendar_to.selectedDate ||
        this.temp_calendar_from != this.calendar_from.selectedDate ||
        this.temp_flightTo != this.input.flightTo ||
        this.temp_flightFrom != this.input.flightFrom ||
        this.temp_class != this.input.class ||
        this.passengers.length != this.temp_passenger)
    ) {
      //*---------------------------------------------------------------------------------------------------*//
      (this.temp_back = this.back),
        (this.temp_calendar_to = this.calendar_to.selectedDate);
      (this.temp_calendar_from = this.calendar_from.selectedDate),
        (this.temp_flightTo = this.input.flightTo);
      (this.temp_flightFrom = this.input.flightFrom),
        (this.temp_class = this.input.class),
        (this.temp_passenger = this.passengers.length);
      this.loadingPage = true;
      this.input.departDate = this.calendar_from.selectedDate;
      this.input.returnDate = this.calendar_to.selectedDate;
      let data = {
        back: this.back,
        input: this.input,
        passengerCount: this.passengers.length
      };
      axios.post("/api/user/getFlight", data).then(response => {
        this.loadingPage = false;
        console.log("query", response.data);
        this.queryFlight = response.data.flight_depart;
        this.queryReturnFlight = response.data.flight_return;
      });
=======
    beforeUpdate() {
        if (
            (!this.back || !(this.back ^ !!this.calendar_to.selectedDate)) &&
            !!this.calendar_from.selectedDate &&
            !!this.input.flightTo &&
            !!this.input.flightFrom &&
            !!this.input.class &&
            (this.temp_back != this.back ||
                this.temp_calendar_to != this.calendar_to.selectedDate ||
                this.temp_calendar_from != this.calendar_from.selectedDate ||
                this.temp_flightTo != this.input.flightTo ||
                this.temp_flightFrom != this.input.flightFrom ||
                this.temp_class != this.input.class ||
                this.passengers.length != this.temp_passenger)
        ) {
            //*---------------------------------------------------------------------------------------------------*//
            this.temp_back = this.back;
            this.temp_calendar_to = this.calendar_to.selectedDate;
            this.temp_calendar_from = this.calendar_from.selectedDate;
            this.temp_flightTo = this.input.flightTo;
            this.temp_flightFrom = this.input.flightFrom;
            this.temp_class = this.input.class;
            this.temp_passenger = this.passengers.length;
            this.loadingPage = true;
            this.isSelected = false;
            this.isReturnSelected = false;
            this.isActive = null;
            this.isReturnActive = null;
            this.seats = [];
            this.seatReturn = [];
            this.input.departDate = this.calendar_from.selectedDate;
            this.input.returnDate = this.calendar_to.selectedDate;
            let data = {
                back: this.back,
                input: this.input,
                passengerCount: this.passengers.length
            };
            axios.post("/api/user/getFlight", data).then(response => {
                this.loadingPage = false;
                this.queryFlight = response.data.flight_depart;
                this.queryReturnFlight = response.data.flight_return;
                this.no_of_passenger = this.passengers.length;
            });
        }
        if (
            !this.input.class ||
            !this.input.flightTo ||
            !this.input.flightFrom
        ) {
            this.loadingPage = true;
            this.temp_class = this.temp_flightTo = this.temp_flightFrom = null;
            this.queryFlight = [];
            this.queryReturnFlight = [];
            this.loadingPage = false;
        }

        if (this.check_cal === this.changePage) {
            var price_type =
                this.input.class == "Economy"
                    ? "eco_price"
                    : this.input.class == "Business"
                    ? "bus_price"
                    : "first_price";
            if (this.changePage)
                this.depart_price = parseFloat(
                    this.depart_Selected[price_type]
                );
            if (this.changePage)
                this.return_price = this.back
                    ? parseFloat(this.return_Selected[price_type])
                    : 0;
            this.check_cal = !this.changePage;
        }
        // for depart
        if (this.changePage && this.check_Dseat != this.seats.length) {
            this.check_Dseat = this.seats.length;
            var seated = [];
            this.seats.forEach(element => {
                seated.push(element["seat"]);
            });
            if (this.input.class == "First") {
                this.firsts.forEach(element => {
                    element.forEach(seat => {
                        if (this.seats.length == this.no_of_passenger) {
                            if (
                                !("patt" in seat) &&
                                seated.indexOf(seat["seat"]) == -1
                            )
                                seat["status"] = true;
                        } else {
                            if (
                                !("patt" in seat) &&
                                this.D_already_seat.indexOf(seat["seat"]) == -1
                            )
                                seat["status"] = false;
                        }
                    });
                });
            }
            if (this.input.class == "Business") {
                this.buss.forEach(element => {
                    element.forEach(seat => {
                        if (this.seats.length == this.no_of_passenger) {
                            if (
                                !("patt" in seat) &&
                                seated.indexOf(seat["seat"]) == -1
                            )
                                seat["status"] = true;
                        } else {
                            if (
                                !("patt" in seat) &&
                                this.D_already_seat.indexOf(seat["seat"]) == -1
                            )
                                seat["status"] = false;
                        }
                    });
                });
            }
            if (this.input.class == "Economy") {
                this.ecos.forEach(element => {
                    element.forEach(seat => {
                        if (this.seats.length == this.no_of_passenger) {
                            if (
                                !("patt" in seat) &&
                                seated.indexOf(seat["seat"]) == -1
                            )
                                seat["status"] = true;
                        } else {
                            if (
                                !("patt" in seat) &&
                                this.D_already_seat.indexOf(seat["seat"]) == -1
                            )
                                seat["status"] = false;
                        }
                    });
                });
            }
        }
        // for return
        if (this.changePage && this.check_Rseat != this.seatReturn.length) {
            this.check_Rseat = this.seatReturn.length;
            var seated = [];
            this.seatReturn.forEach(element => {
                seated.push(element["seat"]);
            });
            if (this.input.class == "First") {
                this.firsts2.forEach(element => {
                    element.forEach(seat => {
                        if (this.seatReturn.length == this.no_of_passenger) {
                            if (
                                !("patt" in seat) &&
                                seated.indexOf(seat["seat"]) == -1
                            )
                                seat["status"] = true;
                        } else {
                            if (
                                !("patt" in seat) &&
                                this.R_already_seat.indexOf(seat["seat"]) == -1
                            )
                                seat["status"] = false;
                        }
                    });
                });
            }
            if (this.input.class == "Business") {
                this.buss2.forEach(element => {
                    element.forEach(seat => {
                        if (this.seatReturn.length == this.no_of_passenger) {
                            if (
                                !("patt" in seat) &&
                                seated.indexOf(seat["seat"]) == -1
                            )
                                seat["status"] = true;
                        } else {
                            if (
                                !("patt" in seat) &&
                                this.R_already_seat.indexOf(seat["seat"]) == -1
                            )
                                seat["status"] = false;
                        }
                    });
                });
            }
            if (this.input.class == "Economy") {
                this.ecos2.forEach(element => {
                    element.forEach(seat => {
                        if (this.seatReturn.length == this.no_of_passenger) {
                            if (
                                !("patt" in seat) &&
                                seated.indexOf(seat["seat"]) == -1
                            )
                                seat["status"] = true;
                        } else {
                            if (
                                !("patt" in seat) &&
                                this.R_already_seat.indexOf(seat["seat"]) == -1
                            )
                                seat["status"] = false;
                        }
                    });
                });
            }
        }
        if (!this.changePage) {
            this.check_Dseat = this.check_Rseat = -1;
        }
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
    }
  }
};
</script>

<style>
#btn-selected {
<<<<<<< HEAD
  border-radius: 0px;
  border: none;
  color: #fff;
  background: #f1ad2f;
}
#btn-selected:hover {
  border: none;
  color: #fff;
  transition: 0.3s;
  font-size: 20px;
  background: #f1ad2f;
  border-radius: 0px;
=======
    border-radius: 0px;
    border: none;
    color: #fff;
    background: #f7dd72;
}
#btn-selected:hover {
    border: none;
    color: #fff;
    transition: 0.3s;
    font-size: 20px;
    background: #f7dd72;
    border-radius: 0px;
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
}

/* .reservation {
    background-color: #4bb4de;
} */
.card-header {
<<<<<<< HEAD
  border: none;
  border-radius: 0;
  background-color: #f79c65;
  display: block;
  text-align: center;
  color: #fff;
=======
    border: none;
    border-radius: 0;
    background-color: #f79c65;
    display: block;
    color: #fff;
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
}
/* #f8d49b */
#card-reservation {
  border: none;
  border-radius: 0;
}
.column-reservation {
  float: left;
  width: 100%;
  padding: 0 10px;
  margin-top: 10px;
}
.card-reser {
<<<<<<< HEAD
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  color: #fff;
  background-color: #2197e6;
=======
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    padding: 16px;
    text-align: center;
    color: #fff;
    background-color: #a5c882;
>>>>>>> 703fc7cfccca6632e270ce7b4595e6403e2c04a8
}
</style>
