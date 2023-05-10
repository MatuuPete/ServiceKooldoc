$(document).ready(function() {
    const token = localStorage.getItem('access_token');

    $.ajax({
        url: 'api/multi-bookings',
        type: 'GET',
        headers: {
            "Authorization": "Bearer " + token
        },
        success: function(data) {
            Highcharts.chart('daily-bookings-chart', {
                chart: {
                    type: 'line',
                },
                title: {
                    text: 'Daily Bookings'
                },
                xAxis: {
                    categories: data.daily_bookings.map(function(item) { return item.day; }),
                },
                yAxis: {
                    title: {
                        text: 'Bookings',
                    },
                    tickInterval: 1,
                },
                series: [{
                    name: 'Total Bookings',
                    color: '#137EC4',
                    data: data.daily_bookings.map(function(item) { return item.total_count; })
                }, {
                    name: 'Cleaning',
                    color: '#28a745',
                    data: data.daily_bookings.map(function(item) { return item.cleaning_count; })
                }, {
                    name: 'Installation',
                    color: '#ffc107',
                    data: data.daily_bookings.map(function(item) { return item.installation_count; })
                }, {
                    name: 'Repair',
                    color: '#dc3545',
                    data: data.daily_bookings.map(function(item) { return item.repair_count; }),
                }, {
                    name: 'Maintenance',
                    color: '#000000',
                    data: data.daily_bookings.map(function(item) { return item.maintenance_count; })
                }],
                exporting: {
                    enabled: true,
                    buttons: {
                        contextButton: {
                            menuItems: [
                                'viewFullscreen',
                                'separator',
                                'downloadPNG',
                                'downloadJPEG',
                                'downloadSVG',
                                'separator',
                                'downloadPDF',
                                'downloadXLS',
                                'downloadCSV'
                            ]
                        }
                    }
                },
                legend: {
                    align: 'left',
                    verticalAlign: 'middle',
                    layout: 'vertical',
                    itemMarginTop: 10,
                    itemMarginBottom: 10
                },
                tooltip: {
                    shared: true,
                    valueDecimals: 0
                }
            });

            Highcharts.chart('weekly-bookings-chart', {
                chart: {
                    type: 'line',
                },
                title: {
                    text: 'Weekly Bookings'
                },
                xAxis: {
                    categories: data.weekly_bookings.map(function(item) { return item.day; }),
                },
                yAxis: {
                    title: {
                        text: 'Bookings',
                    },
                    tickInterval: 1,
                },
                series: [{
                    name: 'Total Bookings',
                    color: '#137EC4',
                    data: data.weekly_bookings.map(function(item) { return item.total_count; })
                }, {
                    name: 'Cleaning',
                    color: '#28a745',
                    data: data.weekly_bookings.map(function(item) { return item.cleaning_count; })
                }, {
                    name: 'Installation',
                    color: '#ffc107',
                    data: data.weekly_bookings.map(function(item) { return item.installation_count; })
                }, {
                    name: 'Repair',
                    color: '#dc3545',
                    data: data.weekly_bookings.map(function(item) { return item.repair_count; }),
                }, {
                    name: 'Maintenance',
                    color: '#000000',
                    data: data.weekly_bookings.map(function(item) { return item.maintenance_count; })
                }],
                exporting: {
                    enabled: true,
                    buttons: {
                        contextButton: {
                            menuItems: [
                                'viewFullscreen',
                                'separator',
                                'downloadPNG',
                                'downloadJPEG',
                                'downloadSVG',
                                'separator',
                                'downloadPDF',
                                'downloadXLS',
                                'downloadCSV'
                            ]
                        }
                    }
                },
                legend: {
                    align: 'left',
                    verticalAlign: 'middle',
                    layout: 'vertical',
                    itemMarginTop: 10,
                    itemMarginBottom: 10
                },
                tooltip: {
                    shared: true,
                    valueDecimals: 0
                }
            });
        
            Highcharts.chart('monthly-bookings-chart', {
                chart: {
                    type: 'line',
                },
                title: {
                    text: 'Monthly Bookings'
                },
                xAxis: {
                    categories: data.monthly_bookings.map(function(item) { return item.month; }),
                },
                yAxis: {
                    title: {
                        text: 'Bookings',
                    },
                    tickInterval: 1,
                },
                series: [{
                    name: 'Total Bookings',
                    color: '#137EC4',
                    data: data.monthly_bookings.map(function(item) { return item.total_count; })
                }, {
                    name: 'Cleaning',
                    color: '#28a745',
                    data: data.monthly_bookings.map(function(item) { return item.cleaning_count; })
                }, {
                    name: 'Installation',
                    color: '#ffc107',
                    data: data.monthly_bookings.map(function(item) { return item.installation_count; })
                }, {
                    name: 'Repair',
                    color: '#dc3545',
                    data: data.monthly_bookings.map(function(item) { return item.repair_count; }),
                }, {
                    name: 'Maintenance',
                    color: '#000000',
                    data: data.monthly_bookings.map(function(item) { return item.maintenance_count; })
                }],
                exporting: {
                    enabled: true,
                    buttons: {
                        contextButton: {
                            menuItems: [
                                'viewFullscreen',
                                'separator',
                                'downloadPNG',
                                'downloadJPEG',
                                'downloadSVG',
                                'separator',
                                'downloadPDF',
                                'downloadXLS',
                                'downloadCSV'
                            ]
                        }
                    }
                },
                legend: {
                    align: 'left',
                    verticalAlign: 'middle',
                    layout: 'vertical',
                    itemMarginTop: 10,
                    itemMarginBottom: 10
                },
                tooltip: {
                    shared: true,
                    valueDecimals: 0
                }
            });

            Highcharts.chart('yearly-bookings-chart', {
                chart: {
                    type: 'line',
                },
                title: {
                    text: 'Yearly Bookings'
                },
                xAxis: {
                    categories: data.yearly_bookings.map(function(item) { return item.year; }),
                },
                yAxis: {
                    title: {
                        text: 'Bookings',
                    },
                    tickInterval: 1,
                },
                series: [{
                    name: 'Total Bookings',
                    color: '#137EC4',
                    data: data.yearly_bookings.map(function(item) { return item.total_count; })
                }, {
                    name: 'Cleaning',
                    color: '#28a745',
                    data: data.yearly_bookings.map(function(item) { return item.cleaning_count; })
                }, {
                    name: 'Installation',
                    color: '#ffc107',
                    data: data.yearly_bookings.map(function(item) { return item.installation_count; })
                }, {
                    name: 'Repair',
                    color: '#dc3545',
                    data: data.yearly_bookings.map(function(item) { return item.repair_count; }),
                }, {
                    name: 'Maintenance',
                    color: '#000000',
                    data: data.yearly_bookings.map(function(item) { return item.maintenance_count; })
                }],
                exporting: {
                    enabled: true,
                    buttons: {
                        contextButton: {
                            menuItems: [
                                'viewFullscreen',
                                'separator',
                                'downloadPNG',
                                'downloadJPEG',
                                'downloadSVG',
                                'separator',
                                'downloadPDF',
                                'downloadXLS',
                                'downloadCSV'
                            ]
                        }
                    }
                },
                legend: {
                    align: 'left',
                    verticalAlign: 'middle',
                    layout: 'vertical',
                    itemMarginTop: 10,
                    itemMarginBottom: 10
                },
                tooltip: {
                    shared: true,
                    valueDecimals: 0
                }
            });
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });

    $.ajax({
        url: 'api/multi-payments',
        type: 'GET',
        headers: {
            "Authorization": "Bearer " + token
        },
        success: function(data) {
            Highcharts.chart('daily-payments-chart', {
                chart: {
                    type: 'line',
                },
                title: {
                    text: 'Daily Payments'
                },
                xAxis: {
                    categories: data.daily_payments.map(function(item) { return item.day; }),
                },
                yAxis: {
                    title: {
                        text: 'Payments',
                    },
                    tickInterval: 1000,
                    formatter: function() {
                        return Highcharts.numberFormat(this.value, 2);
                    }
                },
                series: [{
                    name: 'Total Payments',
                    color: '#137EC4',
                    data: data.daily_payments.map(function(item) { return item.total_amount; })
                }, {
                    name: 'Cleaning',
                    color: '#28a745',
                    data: data.daily_payments.map(function(item) { return item.cleaning_amount; })
                }, {
                    name: 'Installation',
                    color: '#ffc107',
                    data: data.daily_payments.map(function(item) { return item.installation_amount; })
                }, {
                    name: 'Repair',
                    color: '#dc3545',
                    data: data.daily_payments.map(function(item) { return item.repair_amount; }),
                }, {
                    name: 'Maintenance',
                    color: '#000000',
                    data: data.daily_payments.map(function(item) { return item.maintenance_amount; })
                }],
                exporting: {
                    enabled: true,
                    buttons: {
                        contextButton: {
                            menuItems: [
                                'viewFullscreen',
                                'separator',
                                'downloadPNG',
                                'downloadJPEG',
                                'downloadSVG',
                                'separator',
                                'downloadPDF',
                                'downloadXLS',
                                'downloadCSV'
                            ]
                        }
                    }
                },
                legend: {
                    align: 'left',
                    verticalAlign: 'middle',
                    layout: 'vertical',
                    itemMarginTop: 10,
                    itemMarginBottom: 10
                },
                tooltip: {
                    shared: true,
                    formatter: function() {
                        var points = this.points;
                        var tooltip = '<b>' + this.x + '</b><br/>';
                        tooltip += points.map(function(point) {
                            return '<span style="color:' + point.color + '">\u25CF</span> ' + point.series.name + ': ' + Highcharts.numberFormat(point.y, 2);
                        }).join('<br/>');
                        return tooltip;
                    }
                }
            });

            Highcharts.chart('weekly-payments-chart', {
                chart: {
                    type: 'line',
                },
                title: {
                    text: 'Weekly Payments'
                },
                xAxis: {
                    categories: data.weekly_payments.map(function(item) { return item.day; }),
                },
                yAxis: {
                    title: {
                        text: 'Payments',
                    },
                    tickInterval: 1000,
                    formatter: function() {
                        return Highcharts.numberFormat(this.value, 2);
                    }
                },
                series: [{
                    name: 'Total Payments',
                    color: '#137EC4',
                    data: data.weekly_payments.map(function(item) { return item.total_amount; })
                }, {
                    name: 'Cleaning',
                    color: '#28a745',
                    data: data.weekly_payments.map(function(item) { return item.cleaning_amount; })
                }, {
                    name: 'Installation',
                    color: '#ffc107',
                    data: data.weekly_payments.map(function(item) { return item.installation_amount; })
                }, {
                    name: 'Repair',
                    color: '#dc3545',
                    data: data.weekly_payments.map(function(item) { return item.repair_amount; }),
                }, {
                    name: 'Maintenance',
                    color: '#000000',
                    data: data.weekly_payments.map(function(item) { return item.maintenance_amount; })
                }],
                exporting: {
                    enabled: true,
                    buttons: {
                        contextButton: {
                            menuItems: [
                                'viewFullscreen',
                                'separator',
                                'downloadPNG',
                                'downloadJPEG',
                                'downloadSVG',
                                'separator',
                                'downloadPDF',
                                'downloadXLS',
                                'downloadCSV'
                            ]
                        }
                    }
                },
                legend: {
                    align: 'left',
                    verticalAlign: 'middle',
                    layout: 'vertical',
                    itemMarginTop: 10,
                    itemMarginBottom: 10
                },
                tooltip: {
                    shared: true,
                    formatter: function() {
                        var points = this.points;
                        var tooltip = '<b>' + this.x + '</b><br/>';
                        tooltip += points.map(function(point) {
                            return '<span style="color:' + point.color + '">\u25CF</span> ' + point.series.name + ': ' + Highcharts.numberFormat(point.y, 2);
                        }).join('<br/>');
                        return tooltip;
                    }
                }
            });

            Highcharts.chart('monthly-payments-chart', {
                chart: {
                    type: 'line',
                },
                title: {
                    text: 'Monthly Payments'
                },
                xAxis: {
                    categories: data.monthly_payments.map(function(item) { return item.month; }),
                },
                yAxis: {
                    title: {
                        text: 'Payments',
                    },
                    tickInterval: 1000,
                    formatter: function() {
                        return Highcharts.numberFormat(this.value, 2);
                    }
                },
                series: [{
                    name: 'Total Payments',
                    color: '#137EC4',
                    data: data.monthly_payments.map(function(item) { return item.total_amount; })
                }, {
                    name: 'Cleaning',
                    color: '#28a745',
                    data: data.monthly_payments.map(function(item) { return item.cleaning_amount; })
                }, {
                    name: 'Installation',
                    color: '#ffc107',
                    data: data.monthly_payments.map(function(item) { return item.installation_amount; })
                }, {
                    name: 'Repair',
                    color: '#dc3545',
                    data: data.monthly_payments.map(function(item) { return item.repair_amount; }),
                }, {
                    name: 'Maintenance',
                    color: '#000000',
                    data: data.monthly_payments.map(function(item) { return item.maintenance_amount; })
                }],
                exporting: {
                    enabled: true,
                    buttons: {
                        contextButton: {
                            menuItems: [
                                'viewFullscreen',
                                'separator',
                                'downloadPNG',
                                'downloadJPEG',
                                'downloadSVG',
                                'separator',
                                'downloadPDF',
                                'downloadXLS',
                                'downloadCSV'
                            ]
                        }
                    }
                },
                legend: {
                    align: 'left',
                    verticalAlign: 'middle',
                    layout: 'vertical',
                    itemMarginTop: 10,
                    itemMarginBottom: 10
                },
                tooltip: {
                    shared: true,
                    formatter: function() {
                        var points = this.points;
                        var tooltip = '<b>' + this.x + '</b><br/>';
                        tooltip += points.map(function(point) {
                            return '<span style="color:' + point.color + '">\u25CF</span> ' + point.series.name + ': ' + Highcharts.numberFormat(point.y, 2);
                        }).join('<br/>');
                        return tooltip;
                    }
                }
            });

            Highcharts.chart('yearly-payments-chart', {
                chart: {
                    type: 'line',
                },
                title: {
                    text: 'Yearly Payments'
                },
                xAxis: {
                    categories: data.yearly_payments.map(function(item) { return item.year; }),
                },
                yAxis: {
                    title: {
                        text: 'Payments',
                    },
                    tickInterval: 1000,
                    formatter: function() {
                        return Highcharts.numberFormat(this.value, 2);
                    }
                },
                series: [{
                    name: 'Total Payments',
                    color: '#137EC4',
                    data: data.yearly_payments.map(function(item) { return item.total_amount; })
                }, {
                    name: 'Cleaning',
                    color: '#28a745',
                    data: data.yearly_payments.map(function(item) { return item.cleaning_amount; })
                }, {
                    name: 'Installation',
                    color: '#ffc107',
                    data: data.yearly_payments.map(function(item) { return item.installation_amount; })
                }, {
                    name: 'Repair',
                    color: '#dc3545',
                    data: data.yearly_payments.map(function(item) { return item.repair_amount; }),
                }, {
                    name: 'Maintenance',
                    color: '#000000',
                    data: data.yearly_payments.map(function(item) { return item.maintenance_amount; })
                }],
                exporting: {
                    enabled: true,
                    buttons: {
                        contextButton: {
                            menuItems: [
                                'viewFullscreen',
                                'separator',
                                'downloadPNG',
                                'downloadJPEG',
                                'downloadSVG',
                                'separator',
                                'downloadPDF',
                                'downloadXLS',
                                'downloadCSV'
                            ]
                        }
                    }
                },
                legend: {
                    align: 'left',
                    verticalAlign: 'middle',
                    layout: 'vertical',
                    itemMarginTop: 10,
                    itemMarginBottom: 10
                },
                tooltip: {
                    shared: true,
                    formatter: function() {
                        var points = this.points;
                        var tooltip = '<b>' + this.x + '</b><br/>';
                        tooltip += points.map(function(point) {
                            return '<span style="color:' + point.color + '">\u25CF</span> ' + point.series.name + ': ' + Highcharts.numberFormat(point.y, 2);
                        }).join('<br/>');
                        return tooltip;
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });

    $.ajax({
        url: '/api/bookings-service-type',
        type: 'GET',
        headers: {
            "Authorization": "Bearer " + token
        },
        success: function(response) {
            var data = response.map(function(item) {
                return {name: item.service_type.charAt(0).toUpperCase() + item.service_type.slice(1), y: item.value};
            });

            Highcharts.chart('bookings-service-type', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Bookings by Service Type'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                plotOptions: {
                pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}'
                        }
                    }
                },
                colors: ['#0077b6', '#00b4d8', '#90e0ef', '#caf0f8'],
                exporting: {
                    enabled: true,
                    buttons: {
                        contextButton: {
                            menuItems: [
                                'viewFullscreen',
                                'separator',
                                'downloadPNG',
                                'downloadJPEG',
                                'downloadSVG',
                                'separator',
                                'downloadPDF',
                                'downloadXLS',
                                'downloadCSV'
                            ]
                        }
                    }
                },
                series: [{
                    name: 'Bookings',
                    data: data
                }]
            });
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });   
    
    $.ajax({
        url: '/api/bookings-barangay',
        type: 'GET',
        headers: {
            "Authorization": "Bearer " + token
        },
        success: function(response) {
            var data = response.map(function(item) {
                return {name: item.barangay.charAt(0).toUpperCase() + item.barangay.slice(1), y: item.value};
            });
    
            Highcharts.chart('bookings-barangay', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Bookings by Barangay'
                },
                xAxis: {
                    categories: data.map(function(item) {
                        return item.name;
                    }),
                    title: {
                        text: 'Barangay'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Number of Bookings'
                    }
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                colors: ['#137EC4'],
                exporting: {
                    enabled: true,
                    buttons: {
                        contextButton: {
                            menuItems: [
                                'viewFullscreen',
                                'separator',
                                'downloadPNG',
                                'downloadJPEG',
                                'downloadSVG',
                                'separator',
                                'downloadPDF',
                                'downloadXLS',
                                'downloadCSV'
                            ]
                        }
                    }
                },
                series: [{
                    name: 'Bookings',
                    data: data.map(function(item) {
                        return item.y;
                    })
                }]
            });
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });  

    $.ajax({
        url: '/api/inventory-report',
        type: 'GET',
        headers: {
            "Authorization": "Bearer " + token
        },
        success: function(response) {
            var data = response.map(function(item) {
                return {name: item.name.charAt(0).toUpperCase() + item.name.slice(1), y: item.count};
            });
    
            Highcharts.chart('inventory-report', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Inventory Report'
                },
                xAxis: {
                    type: 'category',
                },
                yAxis: {
                    title: {
                        text: 'Borrowed'
                    }
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                plotOptions: {
                    column: {
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.y}</b>'
                        }
                    }
                },
                colors: ['#137EC4'],
                exporting: {
                    enabled: true,
                    buttons: {
                        contextButton: {
                            menuItems: [
                                'viewFullscreen',
                                'separator',
                                'downloadPNG',
                                'downloadJPEG',
                                'downloadSVG',
                                'separator',
                                'downloadPDF',
                                'downloadXLS',
                                'downloadCSV'
                            ]
                        }
                    }
                },
                series: [{
                    name: 'Borrowed',
                    data: data
                }]
            });
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });    
    
    $.ajax({
        url: '/api/technician-services',
        type: 'GET',
        headers: {
            "Authorization": "Bearer " + token
        },
        success: function(response) {
            var data = response.map(function(item) {
                return {name: item.technician.charAt(0).toUpperCase() + item.technician.slice(1), y: item.count};
            });
    
            Highcharts.chart('technician-services', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Technician Services'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}'
                        }
                    }
                },
                colors: ['#0077b6', '#00b4d8', '#90e0ef', '#caf0f8'],
                exporting: {
                    enabled: true,
                    buttons: {
                        contextButton: {
                            menuItems: [
                                'viewFullscreen',
                                'separator',
                                'downloadPNG',
                                'downloadJPEG',
                                'downloadSVG',
                                'separator',
                                'downloadPDF',
                                'downloadXLS',
                                'downloadCSV'
                            ]
                        }
                    }
                },
                series: [{
                    name: 'Services',
                    data: data
                }]
            });
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    }); 
});