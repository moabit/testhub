import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        timeLimit: null,
        tags: [],
        questions: [],
        passRate: null,
        title: "",
        description: ""
    },
    mutations: {
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
                    if (question.answers.length === 1) {
                        question.answers[0].isCorrect = false;
                    }
                    maxId = Math.max.apply(Math, question.answers.map(function (answer) {
                        return answer.id;
                    }));
                }
                for (let i = 1; i < dif + 1; i++) {
                    question.answers.push({id: maxId + i,isCorrect : false});
                }
            } else {
                dif = question.answers.length - payload.value;
                for (let i = 0; i < dif; i++) {
                    question.answers.pop();
                }
            }
            if (question.answers.length === 1) {
                question.answers[0].isCorrect = true;
            }
        },
        addQuestion: (state) => {
            let maxId;
            state.questions.length !== 0 ? maxId = Math.max.apply(Math, state.questions.map(function (question) {
                return question.id;
            })) : maxId = 0;
            state.questions.push({id: maxId + 1, question: '', answers: []});
        },
        deleteQuestion: (state, id) => {
            let questionIndex = state.questions.findIndex(question => question.id === id);
            state.questions.splice(questionIndex, 1);
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
            state.questions.find(question => question.id === payload.id).question = payload.value;
        },
        updateAnswer: (state, payload) => {
            state.questions.find(question => question.id === payload.questionId).answers.find(answer => answer.id === payload.answerId).answer = payload.value;

        },
        setAnswerStatus: (state, payload) => {
            state.questions.find(question => question.id === payload.questionId).answers.find(answer => answer.id === payload.answerId).isCorrect = payload.value;
        },
        updatePassRate: (state, value) => {
            state.passRate = value === null ? null : parseInt(value);
        },
        updateTimeLimit: (state, value) => {
            state.timeLimit = value === null ? null : parseInt(value);
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
