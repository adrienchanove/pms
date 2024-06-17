new Vue({
    el: '#app',
    data: {
        reservations: [],
        reservationsFiltered: [],
        inputName: '',
        inputHouse: '',
        inputStartDate : '',
        inputEndDate : ''
    },
    mounted() {
        fetch('/api/reservations/all')
            .then(response => response.json())
            .then(data => {
                this.reservations = data;
                this.reservationsFiltered = data;
            }
        );
    },
    methods: {
        search: function() {
            format = 'YYYY-MM-DD';
            let startDate = '';
            if (this.inputStartDate != '') {
                startDate = new Date(this.inputStartDate);
                startDate = startDate.toISOString().split('T')[0];
            }
            let endDate = '';
            if (this.inputEndDate != '') {
                endDate = new Date(this.inputEndDate);
                endDate = endDate.toISOString().split('T')[0];
            }
            let name = this.inputName.toLowerCase();
            let house = this.inputHouse.toLowerCase();
            
            this.reservationsFiltered = this.reservations.filter(reservation => {
                
                return reservation.name.toLowerCase().includes(name) &&
                    reservation.house.name.toLowerCase().includes(house) &&
                    reservation.startDate.includes(startDate) &&
                    reservation.endDate.includes(endDate);
            });

            
        },
    }
    
});