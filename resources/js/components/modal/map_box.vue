<template>
    <div class="modal" :class="{'modal_close':!view}">
        <header_map @close="close_modal"></header_map>
        <div class="modal_map_title" v-if="address != ''">{{address}}</div>
        <div id="map_box"></div>
        <div class="modal_button" @click="close">
            <div>Сюда</div>
        </div>
    </div>
</template>

<script>
    import header_map from '../header/header_map';
    export default {
        props: ['view'],
        components: {
            header_map
        },
        name: "map_box",
        data: function() {
            return {
                token: 'pk.eyJ1IjoiZXJzYSIsImEiOiJja2RrNnF3NmswZ2lsMnRsNGsycXZrdHZmIn0.yW05ltZtpDUyOkmmvNJTpA',
                style: 'mapbox://styles/ersa/ckdk7sk1p0w3y1io6f00ehd7r',
                address: ''
            }
        },
        mounted() {
            this.init();
        },
        methods: {
            init() {
                let self = this;
                let mapboxgl = require('mapbox-gl/dist/mapbox-gl.js');

                mapboxgl.accessToken = this.token;

                let map = new mapboxgl.Map({
                    container: 'map_box',
                    style: self.style,
                    center: [30.5, 50.5],
                    zoom: 17
                });

                let marker = new mapboxgl.Marker()
                    .setLngLat([30.5, 50.5])
                    .setDraggable(true)
                    .addTo(map);

                function dragEnd() {

                    let lngLat = marker.getLngLat();
                    let url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/'+lngLat.lng+','+lngLat.lat+'.json?access_token='+self.token;

                    axios.get(url).then(function (response) {
                        let data = response.data;
                        if (data.features.length > 0) {
                            self.$emit('coordinates',data);
                            self.address = data.features[0].place_name;;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                }

                marker.on('dragend', dragEnd);
                dragEnd();

            },
            close_modal(status) {
                this.$emit('close',status);
            },
            close() {
                this.$emit('close',false);
            }
        }
    }
</script>

<style scoped lang="scss">
    .modal {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background: white;
        z-index: 100;
        &_close {
            display: none;
        }
        &_button {
            height: 50px;
            position: fixed;
            background: #FFE033;
            left: 9px;
            bottom: 9px;
            right: 9px;
            border-radius: 3px;
            z-index: 10;
            font-weight: bold;
            font-size: 18px;
            line-height: 22px;
            & > div {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
            }
        }
    }
    #map_box {
        height: 100%;
        width: 100%;
        position: relative;
    }
    .modal_map_title {
        position: fixed;
        z-index: 15;
        top: 80px;
        left: 25px;
        right: 25px;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
    }
</style>
