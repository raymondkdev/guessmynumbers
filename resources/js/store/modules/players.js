import {defineStore} from "pinia";
import {playerApi} from "../../api";

export default defineStore('players', {
    state: () => ({
        currentPlayer: {},
    }),
    getters: {},
    actions: {
        async getPlayer(playerId) {
            this.currentPlayer = await playerApi.getPlayer(playerId);
        },
        async createPlayer() {
            this.currentPlayer = await playerApi.createPlayer();
        }
    }
}, {
    persist: true
})
