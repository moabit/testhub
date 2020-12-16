<template>
    <div id="TestInfo" class="card">
        <h4 class="card-header text-center font-weight-bold">Новый тест</h4>
        <div class="row m-3">
            <div class="col-4">
                <label for="testTitle" class="font-weight-bold">Название теста</label>
            </div>
            <div class="col-8">
                <input type="text" class="form-control" placeholder="Название вашего теста" id="testTitle"
                       v-model="title">
            </div>
        </div>
        <div class="row m-3 justify-content-start ">
            <div class="col-4">
                <label for="description" class="font-weight-bold">Описание теста</label>
            </div>
            <div class="col-8">
                <textarea id="description" class="form-control" placeholder="Напишете пару слов о тесте"
                          v-model="description"></textarea>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-4">
                <span class="font-weight-bold">Время на выполнение</span>
            </div>
            <div class="col-8">
                <div>
                    <input type="radio" id="withoutLimit" @click="changeTimeLimit(null)"
                           v-bind:checked="timeLimit===null">
                    <label for="withoutLimit">Без ограничения</label>
                </div>
                <div>
                    <div class="row">
                        <div class="col">
                            <input type="radio" id="withLimit" @click="changeTimeLimit(30)">
                            <label for="withLimit">С ограничением (в минутах)</label></div>
                        <div class="col">
                            <input type="number" v-bind:disabled="!(timeLimit!==null)" v-model="timeLimit">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-4">
                <span class="font-weight-bold">Минимум для прохождения</span>
            </div>
            <div class="col-8">
                <div>
                    <input type="radio" id="withoutPassRate" @click="changePassRate(null)"
                           v-bind:checked="passRate===null">
                    <label for="withoutPassRate">Без минимума</label>
                </div>
                <div>
                    <div class="row">
                        <div class="col">
                            <input type="radio" id="withPassRate" @click="changePassRate(30)"
                                   v-bind:checked="passRate!==null">
                            <label for="withPassRate">Минимум</label>
                        </div>
                        <div class="col">
                            <input type="number" v-model="passRate">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-4">
            <div class="col-4">
                <label for="tags" class="font-weight-bold">Теги</label>
            </div>
            <div class="col-6">
                <input type="text" class="form-control" id="tags" placeholder="напр., &quot;Математика&quot;"
                       v-model="tag">
                <div class="d-inline m-2" v-for="tag in tags">
                    <input type="hidden" name="tags[]" v-bind:value="tag">
                    <span class="badge badge-info">{{ tag }}</span>
                    <button type="button" class="close float-none" aria-label="Close" @click="deleteTag(tag)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-primary" @click="addTag()">Добавить тег</button>
            </div>
        </div>
        <div class="row ml-4">
            <div class="col-4">
                <label for="creatorToken" class="font-weight-bold">Пароль для редактирования</label>
            </div>
            <div class="col-6 p-0">
                <input type="password" id="creatorToken">
                <p class="text-muted">Тут будет пояснение насчет анонимного создания теста</p>
            </div>
        </div>
        <div class="row ml-4 mb-3">
            <div class="col-4">
                <label for="verifyCreatorToken" class="font-weight-bold">Еще раз</label>
            </div>
            <div class="col-6 p-0">
                <input type="password" id="verifyCreatorToken">
            </div>
        </div>
    </div>
</template>
<script>

export default {
    name: 'TestInfo',
    computed: {
        hasTimeLimit() {
            return this.$store.state.hasTimeLimit;
        },
        tags() {
            return this.$store.state.tags;
        },
        passRate: {
            get() {
                return this.$store.state.passRate;
            },
            set(value) {
                this.$store.commit('updatePassRate', value)
            }
        },
        timeLimit: {
            get() {
                return this.$store.state.timeLimit;
            },
            set(value) {
                this.$store.commit('updateTimeLimit', value)
            }
        },
        title: {
            get() {
                return this.$store.state.title;
            },
            set(value) {
                this.$store.commit('updateTitle', value);
            }
        },
        description: {
            get() {
                return this.$store.state.description;
            },
            set(value) {
                this.$store.commit('updateDescription', value);
            }
        }
    },
    methods: {
        changeTimeLimit(value) {
            this.$store.commit('updateTimeLimit', value);
        },
        addTag() {
            this.$store.commit('addTag', this.tag)
            this.tag = null;
        },
        deleteTag(tag) {
            this.$store.commit('deleteTag', tag)
        },
        changePassRate(value) {
            this.$store.commit('updatePassRate', value)
        }
    }
}
</script>
