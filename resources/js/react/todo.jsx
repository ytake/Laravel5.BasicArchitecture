/** @jsx React.DOM */
var TodoList = React.createClass({
    propTypes: {
        items: React.PropTypes.array
    },
    render: function() {
        var createItem = function(itemText) {
            return <li>{itemText}</li>;
        };
        return <ul>{this.props.items.map(createItem)}</ul>;
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
        this.setState({title: e.target.value});
    },
    loadTodoTasks: function() {
        $.ajax({
            url: this.props.callUri,
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                this.setState(
                    {
                        items: data
                    }
                );
            }.bind(this),
            error: function(xhr, status, err) {

            }.bind(this)
        });
    },
    getRequestToken: function() {
        $.get(this.props.tokenUri,
            function(result) {
                if (this.isMounted()) {
                    this.setState({
                        token: result.token
                    });
                }
            }.bind(this)
        );
    },
    componentDidMount: function() {
        this.loadTodoTasks();
        this.getRequestToken();
    },
    handleSubmit: function(e) {
        e.preventDefault();
        $.ajax({
            url: this.props.callUri,
            dataType: 'json',
            type: 'POST',
            data: {
                _token: this.state.token,
                title: this.state.title
            },
            success: function(data) {
                this.setState(
                    {
                        items: data,
                        error: false,
                        title: ''
                    }
                );
            }.bind(this),
            error: function(xhr, status, err) {
                this.setState(
                    {
                        error: xhr.responseJSON.title,
                        title: ''
                    }
                );
            }.bind(this)
        });
    },
    render: function() {
        return (
            <div>
                <h3>TODO</h3>
                <TodoList items={this.state.items} />
                {this.state.error ? <ToDoErrors items={this.state.error} /> : null }
                <form onSubmit={this.handleSubmit}>
                    <input type="hidden" value={this.state.token} />
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
    <TodoApp callUri="/api/v1/todo" tokenUri="/api/v1/token" />,
    document.getElementById("todo")
);
