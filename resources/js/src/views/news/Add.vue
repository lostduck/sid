<template>
<b-row class="match-height">
    <b-col cols="12">
  <b-card-code title="Basic Inputs">
    <b-row>
      <b-col
        md="6"
        xl="4"
        class="mb-1"
      >

        <!-- basic -->
        <b-form-group
          label="Basic Input"
          label-for="basicInput"
        >
          <b-form-input
            id="basicInput"
            placeholder="Enter Email"
          />
        </b-form-group>
      </b-col>

      <b-col
        md="6"
        xl="4"
        class="mb-1"
      >
        <!-- input text with help -->
        <b-form-group>
          <label for="InputHelp">Input text with help</label>
          <small class="text-muted"> eg. <i>someone@example.com</i></small>
          <b-form-input id="InputHelp" />
        </b-form-group>
      </b-col>

      <b-col
        md="6"
        xl="4"
        class="mb-1"
      >
        <!-- disabled input -->
        <b-form-group
          label="Disabled Input"
          label-for="disabledInput"
        >
          <b-form-input
            id="disabledInput"
            disabled
          />
        </b-form-group>
      </b-col>

      <b-col
        md="6"
        xl="4"
      >
        <!-- with helper text -->
        <b-form-group
          label="With Helper Text"
          label-for="helperInput"
          description="Find helper text here for given textbox."
        >
          <b-form-input
            id="helperInput"
            placeholder="Name"
          />
        </b-form-group>
      </b-col>
      <b-col
        md="6"
        xl="4"
      >
        <!-- readonly input -->
        <b-form-group
          label="Readonly Input"
          label-for="readOnlyInput"
        >
          <b-form-input
            id="readOnlyInput"
            value="You can't update me :P"
            readonly
          />
        </b-form-group>
      </b-col>

      <b-col
        md="6"
        xl="4"
      >
        <!-- static text -->
        <b-form-group
          label="Readonly Static Text"
          label-for="plainTextInput"
        >
          <b-form-input
            id="plainTextInput"
            plaintext
            value="email@pixinvent.com"
          />
        </b-form-group>
      </b-col>
    </b-row>

    <template #code>
      {{ codeBasic }}
    </template>
  </b-card-code>
  </b-col>
  </b-row>
  <b-card-code title="Bubble Editor">
    <b-card-text>Bubble is a simple tooltip based theme.</b-card-text>

    <quill-editor
      v-model="content"
      :options="editorOption"
    />
  </b-card-code>
</template>


<script>
import BCardCode from '@core/components/b-card-code'
import {
  BFormInput, BRow, BCol, BFormGroup, BCardText
} from 'bootstrap-vue'
import { codeBasic } from './code'
import { quillEditor } from 'vue-quill-editor'

export default {
  components: {
	  quillEditor,
    BCardCode,
    BFormInput,
    BFormGroup,
    BRow,
    BCol,
	BCardText
  },
  data() {
    return {
      codeBasic,
	  editorOption: {
        theme: 'bubble',
        syntax: false,
        modules: {
          toolbar: [
            ['bold', 'italic'],
            [{ header: [1, 2, 3, 4, 5, 6, false] }],
            ['link', 'image'],
          ],
        },
      },
      content: `<h1 class="ql-align-center">Quill Rich Text Editor</h1>
                    <p class="card-text"><br /></p>
                    <p class="card-text">
                      Quill is a free, <a href="https://github.com/quilljs/quill/">open source</a> WYSIWYG editor built
                      for the modern web. With its
                      <a href="http://quilljs.com/docs/modules/">modular architecture</a> and expressive
                      <a href="http://quilljs.com/docs/api/">API</a>, it is completely customizable to fit any need.
                    </p>
                    <p class="card-text"><br /></p>
                    <iframe
                      class="ql-video ql-align-center"
                      src="https://www.youtube.com/embed/QHH3iSeDBLo?showinfo=0"
                      width="560"
                      height="238"
                    ></iframe>
                    <p class="card-text"><br /></p>
                    <p class="card-text"><br /></p>
                    <h2 class="ql-align-center">Getting Started is Easy</h2>
                    <p class="card-text"><br /></p>
                    <pre>
// &lt;link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"&gt;
// &lt;script src="https://cdn.quilljs.com/1.3.6/quill.min.js" type="text/javascript"&gt;&lt;/script&gt;
var quill = new Quill('#editor', {
    modules: {
        toolbar: '#toolbar'
    },
    theme: 'bubble'
});
// Open your browser's developer console to try out the API!</pre>`,
    }
  },
}
</script>

<style lang="scss">
@import '~@core/scss/vue/libs/quill.scss';
</style>
