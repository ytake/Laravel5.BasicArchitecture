/** @jsx React.DOM */
var TodoList = React.createClass({
    propTypes: {
        items: React.PropTypes.array
    },
    createItem: function(itemText) {
        return <li>
            {itemText.title}
            {(itemText.id !== 1 && itemText.id !== 2) ?
                <a href="#" onClick={this.props.handleDelete.bind(this, itemText)}><i className="mdi-toggle-check-box"></i></a>
                : null}
        </li>;
    },
    render: function() {
        return <ul>{this.props.items.map(this.createItem)}</ul>;
    }
});

var ToDoErrors = React.createClass({
    render: function() {
        return (
            <div className="alert alert-dismissable alert-warning">
                <h4>error!</h4>
                <p>{this.props.items}</p>
            </div>
        );
    }
});

var TodoApp = React.createClass({
    getInitialState: function() {
        return {
            items: [],
            title: ''
        };
    },
    onChange: function(e) {
        this.setState({
            title: e.target.value
        });
    },
    loadTodoTasks: function() {
        this.ajaxRequest('GET', this.props.callUri, []);
    },
    componentDidMount: function() {
        this.loadTodoTasks();
    },
    handleSubmit: function(e) {
        e.preventDefault();
        this.ajaxRequest("POST", this.props.callUri, {title: this.state.title});
    },

    ajaxRequest: function(method, url, data) {
        $.ajax({
            url: url,
            dataType: 'json',
            type: method,
            headers: {
                'X-XSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            data: data,
            success: function (data) {
                this.setState(
                    {
                        items: data,
                        error: false,
                        title: ''
                    }
                );
            }.bind(this),
            error: function (xhr, status, err) {
                this.setState(
                    {
                        error: xhr.responseJSON.title,
                        title: ''
                    }
                );
            }.bind(this)
        });
    },
    handleDelete: function(itemToDelete, e) {
        e.preventDefault();
        this.ajaxRequest("DELETE", this.props.callUri + '/' + itemToDelete.id, []);
    },
    render: function() {
        return (
            <div>
                <h3>TODO</h3>
                <TodoList items={this.state.items} handleDelete={this.handleDelete} />
                {this.state.error ? <ToDoErrors items={this.state.error} /> : null }
                <form onSubmit={this.handleSubmit}>
                    <div className="form-control-wrapper">
                        <input onChange={this.onChange} value={this.state.title} className="form-control empty" />
                    </div>
                    <button className="btn btn-primary">{'Add #' + (this.state.items.length + 1)}</button>
                </form>
            </div>
        );
    }
});

React.renderComponent(
    <TodoApp callUri="/api/v1/todo" />,
    document.getElementById("todo")
);
