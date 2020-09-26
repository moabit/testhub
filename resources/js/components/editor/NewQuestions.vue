<template>
    <div id="NewQuestions">
        <draggable
            v-bind="dragOptions"
            tag="div"
            class="sortable-list"
            :list="list"
            :value="value"
        >
                <div v-for="(question,index) in questions"  class="card mt-2">
                    <h5 class="card-header font-weight-bold">{{index+1}}</h5>
                    Вопрос {{ question }}
                    <div class="row m-3">
                        <div class="col-4">
                            <label for="question" class="font-weight-bold">Текст вопроса</label>
                        </div>
                        <div class="col-8">
                            <textarea id="question" class="form-control" placeholder="" :name="`questions[question${index}][]`">{{ question.text }}</textarea>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-4">
                            <span class="font-weight-bold">Тип вопроса</span>
                        </div>
                        <div class="col-4">
                            <input type="radio" v-bind:id="`withAnswers${question.id}`" v-bind:checked="answersCount(question.id)>1" @change="updateAnswersQuantity(4, question.id)">
                            <label v-bind:for="`withAnswers${question.id}`">С вариантами ответа</label>
                        </div>
                        <div class="col-4">
                            <input type="radio" v-bind:id="`withoutAnswers${question.id}`"   v-bind:checked="answersCount(question.id)===1" @change="updateAnswersQuantity(1, question.id)" >
                            <label v-bind:for="`withoutAnswers${question.id}`">Без вариантов ответа</label>
                        </div>
                    </div>

                    <div v-if="answersCount(question.id)===1" class="row m-3">
                        <div class="col-4">
                            <label v-bind:for="`correctAnswer${question.id}`" class="font-weight-bold">Правильный ответ</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" placeholder="Ответ"
                                   v-bind:id="`correctAnswer${question.id}`">
                        </div>
                    </div>
                    <div v-if="answersCount(question.id)>1">
                    <div class="row m-3">
                        <div class="col-4">
                            <label  v-bind:for="`answers${question.id}`" class="font-weight-bold">Количество ответов</label>
                        </div>
                        <div class="col-8">
                            <select v-bind:id="`answers${question.id}`" @change="updateAnswersQuantity($event.target.value, question.id)" class="custom-select my-1 mr-sm-2">
                                <option v-for="index in 7" v-bind:value="index+1" v-bind:selected="answersCount(question.id)===index+1">{{ index+1}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row m-3">
                        <template v-for="index in answersCount(question.id)">
                            <div class="col-4 mt-1">
                                <input type="text" class="form-control" placeholder="Ответ" id="fgdfg" >
                            </div>
                            <div class="col-2">
                                <input class="form-check-input" type="checkbox" value="true" id="defaultCheck1" name="isTrue">
                            </div>
                        </template>
                    </div>
                    </div>
                    <div class="row justify-content-end m-3">
                        <div class="col-1">
                    <button type="button" class="btn btn-outline-danger" @click="deleteQuestion(question.id)">&times;</button>
                        </div>
                    </div>
                </div>
        </draggable>
        <button type="button" class="btn btn-primary btn-lg btn-block mt-2" @click="addQuestion()">Добавить вопрос</button>
    </div>
</template>


<script>
import {mapGetters} from 'vuex';
import draggable from 'vuedraggable'


export default {
    name: 'NewQuestions',
    components: {
        draggable
    },
    computed: {
        ...mapGetters(['answersCount']),
        answersQuantity() {
            return parseInt(this.$store.state.answersQuantity, 10);
        },
        questions() {
            return this.$store.state.questions;
        }
    },
    methods: {
        updateAnswersQuantity(value, id) {
            this.$store.commit('updateAnswersQuantity', {value:value, id:id});
        },
        addQuestion() {
            this.$store.commit('addQuestion');
        },
        changeQuestionType (value) {
            this.$store.commit('changeQuestionType', value);
        },
        deleteQuestion(id) {
            this.$store.commit('deleteQuestion',id);
        }
    }
}
</script>
