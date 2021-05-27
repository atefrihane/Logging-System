<template>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <label for="">Select date</label>
        <input type="date" class="form-control" v-model="date" />
      </div>
      <div class="col-md-4">
        <label for="">Select user</label>
        <select class="form-control" @change="selectUser($event)">
          <option value="" selected disabled>Select user</option>
          <option
            :value="employee.id"
            v-for="employee in this.employees"
            :key="employee.id"
          >
            {{ formatName(employee) }}
          </option>
        </select>
      </div>
      <div class="col-md-4">
        <label for=""></label>
        <button class="btn btn-primary d-block mt-2" @click="loadLogs()">
          Filter
        </button>
        <button class="btn btn-danger d-block mt-2" @click="reset()">
          Reset
        </button>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h4 class="mb-3">List of employees logs</h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Full name</th>
                  <th scope="col">Start time</th>
                  <th scope="col">End Time</th>
                  <th scope="col">Date</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="log in logs.data" :key="log.id">
                  <td>{{ formatName(log.user) }}</td>
                  <td>{{ formatTime(log.start_date) }}</td>
                  <td>
                    {{
                      log.end_date ? formatTime(log.end_date) : "Not done yet "
                    }}
                  </td>
                  <td>{{ formatDate(log.created_at) }}</td>
                </tr>
              </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
              <pagination
                :data="logs"
                @pagination-change-page="loadLogs"
              ></pagination>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
    this.loadLogs();
  },
  props: ["employees"],
  data() {
    return {
      date: moment().format("YYYY-MM-DD"),
      user_id: "",
      logs: {},
    };
  },
  methods: {
    loadLogs(page = 1) {
      axios
        .get(`/logs/filter??page=${page}&&date=${this.date}&&user_id=${this.user_id}`)
        .then((response) => {
          this.logs = response.data.logs;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    selectUser(event) {
      this.user_id = event.target.value;
    },
    formatName(employee) {
      return employee.first_name + " " + employee.last_name;
    },
    formatTime(date) {
      return moment(date, "YYYY-MM-DD HH:mm:ss").format("HH:mm:ss");
    },
    formatDate(date) {
      return moment(date, "YYYY-MM-DD HH:mm:ss").format("dddd DD MMMM YYYY");
    },

    reset() {
      this.date = "";
      this.user_id = "";
    },
  },
};
</script>