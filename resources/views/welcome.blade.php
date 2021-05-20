<x-layout>
    <div class="x__home">
        <div></div>
        <div class="x__home__form">
            <h1>
                Extract HTML from EML / MSG file and preview it.
            </h1>
            <form
                action="/mail"
                method="POST"
                novalidate="novalidate"
                enctype="multipart/form-data"
            >
                @csrf

                <h2 data-num="1">
                    Choose your email format
                </h2>
                <label for="msg">
                    <input
                        type="radio"
                        name="type"
                        value="MSG"
                        id="msg"
                        class="@error('type') is--invalid @enderror"
                    />
                    MSG format
                </label>
                <label for="eml">
                    <input
                        type="radio"
                        name="type"
                        value="EML"
                        id="eml"
                        class="@error('type') is--invalid @enderror"
                    />
                    EML format
                </label>

                @error('type')
                    <div class="has--error">{{ $message }}</div>
                @enderror

                <h2 data-num="2">
                    Choose your EML file for upload
                </h2>
                <div class="for--file">
                    <input
                        type="file"
                        name="mail"
                        id="mail"
                        accept=".eml"
                    />
                    <button type="button">
                        choose .eml file
                    </button>
                    <span>
                        No file selected
                    </span>
                </div>
                @error('mail')
                    <div class="has--error">{{ $message }}</div>
                @enderror
                <h2 data-num="3">
                    We'll parse it for you.
                </h2>
                <button type="submit">
                    Parse file
                </button>
            </form>
        </div>
        <div></div>
    </div>
</x-layout>