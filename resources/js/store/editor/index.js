import Vuex from 'vuex';
import Vue from 'vue';
import question from "./modules/question";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        hasTimeLimit: false,
        timeLimit: false,
        tags: [],
        questions: [
        ],
        passRate: 2,
        title: "",
        description: ""
    },
    mutations: {
        switchTimeLimit: state => {
            state.hasTimeLimit = !state.hasTimeLimit;
            state.timeLimit = null;
        },
        addTag: (state, tag) => {
            state.tags.push(tag);
        },
        deleteTag: (state, tag) => {
            let index = state.tags.findIndex(el => tag == el);
            state.tags.splice(index, 1);
        },
        updateAnswersQuantity: (state, payload) => {
            let question = state.questions.find(question => question.id === payload.id);
            let dif, maxId;
            if (payload.value > question.answers.length) {
                dif = payload.value - question.answers.length;
                if (question.answers.length === 0) {
                    maxId = 0;
                } else {
                    if (question.answers.length===1) {
                        question.answers[0].isTrue = false;
                    }
                    maxId = Math.max.apply(Math, question.answers.map(function (answer) {
                        return answer.id;
                    }));
                }
                for (let i = 1; i < dif + 1; i++) {
                    question.answers.push({id: maxId + i});
                }
            } else {
                dif = question.answers.length - payload.value;
                for (let i = 0; i < dif; i++) {
                    question.answers.pop();
                }
            }
            if (question.answers.length === 1) {
                question.answers[0].isTrue = true;
            }
        },
        addQuestion: (state) => {
            let maxId;
            state.questions.length !== 0 ? maxId = Math.max.apply(Math, state.questions.map(function (question) {
                return question.id;
            })) : maxId = 0;
            state.questions.push({id: maxId + 1, text: '', answers: []});
        },
        changeQuestionType: (state, payload) => {

        },
        deleteQuestion: (state, id) => {
            let questionIndex = state.questions.findIndex(question => question.id === id);
            state.questions.splice(questionIndex, 1);
        },
        changePassRate: (state, value) => {
            state.passRate = value;
        },
        updateQuestions: (state, value) => {
            state.questions = value;
        },
        updateTitle: (state, value) => {
            state.title = value;
        },
        updateDescription: (state, value) => {
            state.description = value;
        },
        updateQuestionText: (state, payload) => {
            state.questions.find(question => question.id === payload.id).text = payload.value;
        },
        updateAnswer: (state, payload) => {
            state.questions.find(question => question.id === payload.questionId).answers.find(answer => answer.id === payload.answerId).text = payload.value;

        },
        setAnswerStatus: (state, payload) => {
            state.questions.find(question => question.id === payload.questionId).answers.find(answer => answer.id === payload.answerId).isTrue = payload.value;
        }

    },
    getters: {
        answersCount: state => id => {
            return state.questions.find(question => question.id === id).answers.length;
        },
        questionsCount: state => {
            return state.questions.length;
        },
        answers: state => questionId => {
            return state.questions.find(question => question.id === questionId).answers;
        }
    }
})
