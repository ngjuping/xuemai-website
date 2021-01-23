import { Server, Model,Response  } from 'miragejs'
export function makeServer({ environment = "development" } = {}) {


    let server = new Server({
        environment,

        models: {
            post: Model,
        },

        seeds(server) {
            //create 2 default posts
            server.create("post", {title: "正式启动", content: "马上体验", created_at: "2013-03-01T00:00:00+01:00"});
            server.create("post", {title: "Hello World", content: "Lorem Ipsum", created_at: "2018-03-01T00:00:00+01:00"});
        },


        routes() {

            this.namespace = "api";
            this.get("/posts", (schema,request) => {

                return {
                    posts:[
                        {title: "正式启动", content: "马上体验", created_at: "2013-03-01T00:00:00+01:00"},
                        {title: "Hello World", content: "Lorem Ipsum", created_at: "2018-03-01T00:00:00+01:00"}
                    ]};
            })
        }
    })

    return server;
}
