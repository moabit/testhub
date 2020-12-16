<template>
    <div id="NewQuestions">
        <draggable
            v-bind="dragOptions"
            tag="div"
            class="sortable-list"
            :list="list"
            :value="value"
            :sort=true
            :preventOnFilter=false
            :options="{filter: '.form-control'}"
            v-model="questions"
        >
            <div v-for="(question,index) in questions" class="card mt-2" v-bind:key="question.id">
                <h5 class="card-header font-weight-bold">Вопрос #{{ index + 1 }}</h5>
                <div class="row m-3">
                    <div class="col-4">
                        <label for="question" class="font-weight-bold">Текст вопроса</label>
                    </div>
                    <div class="col-8">
                        <textarea id="question" class="form-control" placeholder=""
                                  @input="updateQuestionText($event.target.value, question.id)">{{
                                question.question
                            }}</textarea>
                    </div>
                </div>
                <div class="row m-3">
                    <div class="col-4">
                        <span class="font-weight-bold">Тип вопроса</span>
                    </div>
                    <div class="col-4">
                        <input type="radio" v-bind:id="`withAnswers${question.id}`"
                               v-bind:checked="answersCount(question.id)>1"
                               @change="updateAnswersQuantity(4, question.id)">
                        <label v-bind:for="`withAnswers${question.id}`">С вариантами ответа</label>
                    </div>
                    <div class="col-4">
                        <input type="radio" v-bind:id="`withoutAnswers${question.id}`"
                               v-bind:checked="answersCount(question.id)===1"
                               @change="updateAnswersQuantity(1, question.id)">
                        <label v-bind:for="`withoutAnswers${question.id}`">Без вариантов ответа</label>
                    </div>
                </div>
                <div v-if="answersCount(question.id)===1" class="row m-3">
                    <div class="col-4">
                        <label v-bind:for="`correctAnswer${question.id}`" class="font-weight-bold">Правильный
                            ответ</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" placeholder="Ответ"
                               v-bind:id="`correctAnswer${question.id}`" @input="updateAnswer($event.target.value, answers(question.id)[0].id, question.id)" >
                    </div>
                </div>
                <div v-if="answersCount(question.id)>1">
                    <div class="row m-3">
                        <div class="col-4">
                            <label v-bind:for="`answers${question.id}`" class="font-weight-bold">Количество
                                ответов</label>
                        </div>
                        <div class="col-8">
                            <select v-bind:id="`answers${question.id}`"
                                    @change="updateAnswersQuantity($event.target.value, question.id)"
                                    class="custom-select my-1 mr-sm-2">
                                <option v-for="index in 7" v-bind:value="index+1"
                                        v-bind:selected="answersCount(question.id)===index+1">{{ index + 1 }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row m-3">
                        <template v-for="answer in answers(question.id)">
                            <div class="col-4 mt-1">
                                <input type="text" class="form-control" placeholder="Ответ"
                                       v-bind:value="answer.answer"
                                       @input="updateAnswer($event.target.value, answer.id, question.id)">
                            </div>
                            <div class="col-2">
                                <input class="form-check-input" type="checkbox"
                                       @change="setAnswerStatus($event.target.checked, answer.id, question.id)">
                            </div>
                        </template>
                    </div>
                </div>
                <div class="row justify-content-end m-3">
                    <div class="col-1">
                        <button type="button" class="btn btn-outline-danger" @click="deleteQuestion(question.id)">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd"
                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </draggable>
        <button type="button" class="btn btn-primary btn-lg btn-block mt-2" @click="addQuestion()">Добавить вопрос
        </button>
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
        ...mapGetters(['answersCount', 'answers']),
        answersQuantity() {
            return parseInt(this.$store.state.answersQuantity, 10);
        },
        questions: {
            get() {
                return this.$store.state.questions;
            },
            set(value) {
                this.$store.commit('updateQuestions', value)
            }
        }
    },
    methods: {
        updateAnswersQuantity(value, id) {
            this.$store.commit('updateAnswersQuantity', {value: value, id: id});
        },
        addQuestion() {
            this.$store.commit('addQuestion');
        },
        changeQuestionType(value) {
            this.$store.commit('changeQuestionType', value);
        },
        deleteQuestion(id) {
            this.$store.commit('deleteQuestion', id);
        },
        updateQuestionText(value, id) {
            this.$store.commit('updateQuestionText', {value: value, id: id});
        },
        updateAnswer(value, answerId, questionId) {
            this.$store.commit('updateAnswer', {value: value, answerId: answerId, questionId: questionId});
        },
        setAnswerStatus(value, answerId, questionId) {
            this.$store.commit('setAnswerStatus', {value: value, answerId: answerId, questionId: questionId});
        }
    }
}
</script>
