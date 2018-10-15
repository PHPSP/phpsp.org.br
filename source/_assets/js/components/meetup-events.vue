<template>
    <div>
        <article v-for="item in items" vi-key="item.id" class="message">
            <div class="message-header">
                <a :href="item.link" target="_blank">{{ item.name }}</a>
            </div>
            <div class="message-body">
                <p>
                    <strong>Onde:</strong> <span>{{ item.venue.name}}</span>.<br>
                    <strong>Quando:</strong> <span>{{ item.local_date }} @ {{ item.local_time}}</span>.<br>
                    <strong>{{ item.yes_rsvp_count }} Confirmados</strong> <span><a :href="item.link" target="_blank">RSVP?</a></span>.
                </p>
            </div>
        </article>
    </div>
</template>

<script>

    export default {
        props: {
            url: {
                required: true,
                type: String
            },
            quantity: {
                type: Number,
                default: 3
            },
            status: {
                type: String,
                default: "upcoming"
            }
        },
        data() {
            return {
                items: []
            }
        },
        mounted() {
            let linksArr = [
                `${this.url}call/?group=php-sp&endpoint=events&photo-host=public&page=${this.quantity}&status=${this.status}`,
                `${this.url}call/?group=phpsp-campinas&endpoint=events&photo-host=public&page=${this.quantity}&status=${this.status}`,
            ];

            let promiseArr = linksArr.map(link => fetch(link).then(response => response.json()));

            let ordered = [];

            Promise.all( promiseArr )
                .then(
                    results => {
                        results.forEach(el => {
                            el.forEach(item => {
                                ordered.push(item);
                            });
                        });

                        this.items = ordered.sort((a, b) => (a.time > b.time) ? 1 : 0).slice(0, this.quantity + 1);
                    }
                )
                .catch(console.log);
        }
    }
</script>

<style scoped>

</style>