<template>
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Dashboard</h3>
            <a
                class="btn btn-primary btn-sm d-none d-sm-inline-block"
                role="button"
                href="#"
                ><Icon type="md-download" /> Generate Report</a
            >
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div
                                    class="text-uppercase text-primary font-weight-bold text-xs mb-1"
                                >
                                    <span>Earnings (monthly)</span>
                                </div>
                                <div class="text-dark font-weight-bold h5 mb-0">
                                    <span>$40,000</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <Icon type="ios-calendar-outline" size="45" color="#dddfeb" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div
                                    class="text-uppercase text-success font-weight-bold text-xs mb-1"
                                >
                                    <span>Earnings (annual)</span>
                                </div>
                                <div class="text-dark font-weight-bold h5 mb-0">
                                    <span>$215,000</span>
                                </div>
                            </div>
                            <div class="col-auto">
                               <Icon type="logo-usd" size="45" color="#dddfeb" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-info py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div
                                    class="text-uppercase text-info font-weight-bold text-xs mb-1"
                                >
                                    <span>Tasks</span>
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div
                                            class="text-dark font-weight-bold h5 mb-0 mr-3"
                                        >
                                            <span>50%</span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm">
                                            <div
                                                class="progress-bar bg-info"
                                                aria-valuenow="50"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                                style="width: 50%"
                                            >
                                                <span class="sr-only">50%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <Icon type="md-clipboard" size="45" color="#dddfeb" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-warning py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col mr-2">
                                <div
                                    class="text-uppercase text-warning font-weight-bold text-xs mb-1"
                                >
                                    <span>Pending Requests</span>
                                </div>
                                <div class="text-dark font-weight-bold h5 mb-0">
                                    <span>18</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <Icon type="ios-chatbubbles-outline" size="45" color="#dddfeb" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    // created() {
    //     console.log(this.$route)
    // }
}
</script>
