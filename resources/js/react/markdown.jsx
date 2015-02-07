var converter = new Showdown.converter({ extensions: ['github'] });
var MarkdownEditor = React.createClass({
    getInitialState: function () {
        return {
            value: ''
        };
    },
    readMarkdown: function() {
        $.ajax({
            url: this.props.callUri,
            dataType: 'json',
            type: 'GET',
            success: function(data) {
                this.setState(
                    {
                        value: data.markdown
                    }
                );
            }.bind(this),
            error: function(xhr, status, err) {

            }.bind(this)
        });
    },
    componentDidMount: function() {
        this.readMarkdown();
    },
    handleChange: function () {
        var markdownValue = this.refs.textarea.getDOMNode().value;
        this.setState({
            value: markdownValue
        });
        $.ajax({
            url: this.props.callUri,
            dataType: 'json',
            type: 'POST',
            headers: {
                'X-XSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            data: {
                markdown: this.state.value
            },
            success: function(data) {

            }.bind(this),
            error: function(xhr, status, err) {

            }.bind(this)
        });
    },
    render: function () {
        return (
            <div className="MarkdownEditor">
                <div className="col-lg-6">
                <h3>Markdown Editor</h3>
                <textarea
                    rows="20"
                    className="form-control"
                    onChange={this.handleChange}
                    ref="textarea"
                    value={this.state.value} />
                </div>
                <div className="col-lg-6">
                <h3>Preview</h3>
                <div className="preview"
                    dangerouslySetInnerHTML={{
                        __html: converter.makeHtml(this.state.value)
                    }}
                />
                </div>
            </div>
        );
    }
});

React.renderComponent(
    <MarkdownEditor callUri="/api/v1/markdown" />,
    document.querySelector(".markdown")
);
