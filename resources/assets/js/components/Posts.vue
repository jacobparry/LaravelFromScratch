<template>
    <div>
        <h2>Posts</h2>
        <form @submit.prevent="addPost" class="mb-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Title" v-model="post.title">
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="Body" v-model="post.body"></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-block">Save</button>
        </form>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a @click="fetchPosts(pagination.prev_page_url)" class="page-link" href="#">Previous</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link text-dark" href="#">Page: {{pagination.current_page}} of {{pagination.last_page}}</a>
                </li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a @click="fetchPosts(pagination.next_page_url)" class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
        <div v-for="post in posts" v-bind:key="post.id" class="card card-body mb-2">
            <h3>{{post.title}}</h3>
            <p>{{post.body}}</p>
            <hr>
            <button @click="editPost(post)" class="btn btn-warning mb-2">Edit</button>

            <button @click="deletePost(post.id)" class="btn btn-danger">Delete</button>
        </div>
    </div>
</template>


<script>
export default {
    data() {
        return {
            posts: [],
            post: {
                id: '',
                title: '',
                body: '',
                user_id: '1',
                cover_image: 'noImage.jpg'
            },
            post_id: '',
            pagination: {},
            edit: false
        }
    },

    created() {
        this.fetchPosts();
    },

    methods: {
        fetchPosts(page_url) {
            let vm = this;
            page_url = page_url || '/api/posts';
            fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    console.log(res.data);
                    this.posts = res.data;
                    vm.makePagination(res.meta, res.links);
                })
                .catch(error => console.log(error));
        },

        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            };
            this.pagination = pagination;
        },

        deletePost(id) {
            if (confirm('Are You Sure?')) {
                fetch(`api/post/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert('Post Removed');
                        this.fetchPosts();
                    })
                    .catch(error => console.log(error));
            }
        },

        addPost() {
            if (this.edit === false) {
                // Add
                console.log(JSON.stringify(this.post));
                fetch('api/post', {
                        method: 'post',
                        body: JSON.stringify(this.post),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.post.title = '';
                        this.post.body = '';
                        alert('Post Added');
                        this.fetchPosts();
                    })
                    .catch(error => console.log(error));
            } else {
                // Update
                console.log(JSON.stringify(this.post));
                fetch('api/post', {
                        method: 'put',
                        body: JSON.stringify(this.post),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.post.title = '';
                        this.post.body = '';
                        alert('Post Updated');
                        this.fetchPosts();
                    })
                    .catch(error => console.log(error));

            }
        },

        editPost(post) {
            this.edit = true;
            this.post.id = post.id;
            this.post.post_id = post.id;
            this.post.title = post.title;
            this.post.body = post.body;
        }
    }
}
</script>
