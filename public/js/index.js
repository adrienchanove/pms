new Vue({
    el: '#app',
    data: {
        reservationsStart: [],
        reservationsEnd: [],
    },
    mounted() {
        fetch('/api/reservations/now')
            .then(response => response.json())
            .then(data => {
                let today = new Date() ;
                // yyyy-mm-dd
                today = today.toISOString().split('T')[0];

                for (let i = 0; i < data.length; i++) {
                    if (today == data[i].startDate) {
                        this.reservationsStart.push(data[i]);
                    }else{
                        this.reservationsEnd.push(data[i]);
                    }
                }
                    

            }
        );
    },
    
});