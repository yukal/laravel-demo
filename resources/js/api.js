import { router } from '@inertiajs/vue3';

export var canSubmit = (form) => (!form.isDirty || form.processing);

// .............................
// Genres

export function createGenre(form) {
    form.post(route('genres.store'), {
        // onSuccess: (params) => {
        //     console.log('onSuccess', params);
        // },
        // onError: (errors) => {
        //     console.log('onError', errors);
        // },
        // onFinish: (params) => {
        //     console.log('onFinish', params);
        // },
    });
}

export function updateGenre(form, genreID) {
    form.put(route('genres.update', genreID), {
        // onSuccess: (params) => {
        //     console.log('onSuccess', params);
        // },
        // onError: (errors) => {
        //     console.log('onError', errors);
        // },
        // onFinish: (params) => {
        //     console.log('onFinish', params);
        // },
    });
}

export function destroyGenre(genreID) {
    router.delete(route('genres.destroy', genreID), {
        // data
    });
}

// .............................
// Movies

export function createMovie(form) {
    if (!(form.poster instanceof File)) {
        form.transform(({ poster, ...data }) => data);
    }

    form.post(route('movies.store'), {
        // onSuccess: (params) => {
        //     console.log('onSuccess', params);
        // },
        // onError: (errors) => {
        //     console.log('onError', errors);
        // },
        // onFinish: (params) => {
        //     console.log('onFinish', params);
        // },
    });
}

export function updateMovie(form, movieID) {
    // if (!(form.poster instanceof File)) {
    //     form.transform(({ poster, ...data }) => data);
    // }

    form.post(route('movies.update', movieID), {
        // onSuccess: (params) => {
        //     console.log('onSuccess', params);
        // },
        // onError: (errors) => {
        //     console.log('onError', errors);
        // },
        // onFinish: (params) => {
        //     console.log('onFinish', params);
        // },
    });
}

export function setMoviePublicity(movieID, flag = true) {
    // console.log('movies.publish', route('movies.publish', movieID));
    router.patch(route('movies.publicity', movieID), {
        published: flag,
    });
}

export function destroyMovie(movieID) {
    router.delete(route('movies.destroy', movieID), {
        // data
    });
}
