<template>
    <div id="TestInfo" class="card">
        <h4 class="card-header text-center font-weight-bold">Новый тест</h4>
        <div class="row m-3">
            <div class="col-4">
                <label for="testTitle" class="font-weight-bold">Название теста</label>
            </div>
            <div class="col-8">
                <input type="text" class="form-control" placeholder="Название вашего теста" id="testTitle" name="test[title]">
            </div>
        </div>
        <div class="row m-3 justify-content-start ">
            <div class="col-4">
                <label for="description" class="font-weight-bold">Описание теста</label>
            </div>
            <div class="col-8">
                <textarea id="description" name="test[description]" class="form-control" placeholder="Напишете пару слов о тесте"></textarea>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-4">
                <span class="font-weight-bold">Время на выполнение</span>
            </div>
            <div class="col-8">
                <div>
                    <input type="radio" id="withoutLimit" name="limit" value="false" @click="switchTimeLimit"
                           v-bind:checked="!hasTimeLimit">
                    <label for="withoutLimit">Без ограничения</label>
                </div>
                <div>
                    <div class="row">
                        <div class="col">
                            <input type="radio" id="withLimit"  @click="switchTimeLimit">
                            <label for="withLimit">С ограничением (в минутах)</label></div>
                        <div class="col">
                            <input type="number" v-model="timeLimit"  name="test[timeLimit]" v-bind:disabled="!hasTimeLimit">
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
                    <input type="radio" id="withoutPassRate" name="test[passRate]" value="false" @click="changePassRate(false)"
                           v-bind:checked="passRate===false">
                    <label for="withoutPassRate">Без минимума</label>
                </div>
                <div>
                    <div class="row">
                        <div class="col">
                            <input type="radio" id="withPassRate" name="limit"   @click="changePassRate(30)" v-bind:checked="passRate!==false">
                            <label for="withPassRate">Минималь (в минутах)</label>
                        </div>
                        <div class="col">
                            <input type="number" v-model="passRate"  name="test[passRate]" >
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
                <input type="text" class="form-control" id="tags"  placeholder="напр., &quot;Математика&quot;" v-model="tag">

                    <div class="d-inline m-2" v-for="tag in tags" >
                        <input type="hidden" name="tags[]" v-bind:value="tag">
                    <span class="badge badge-info">{{tag}}</span>
                        <button type="button" class="close float-none" aria-label="Close" @click="deleteTag(tag)"  >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

            </div>
            <div class="col-2">
                <button type="button" class="btn btn-primary" @click="addTag()">Добавить тег</button>
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
        timeLimit() {
            return this.$store.state.timeLimit;
        },
        tags() {
            return this.$store.state.tags;
        },
        passRate () {
            return this.$store.state.passRate;
        }
    },
    methods: {
        switchTimeLimit() {
            this.$store.commit('switchTimeLimit');
        },
        addTag() {
            this.$store.commit('addTag', this.tag)
            this.tag = null;
        },
        deleteTag(tag) {
            this.$store.commit('deleteTag', tag)
        },
        changePassRate(value) {
            this.$store.commit('changePassRate', value)
        }
    }
}
</script>
