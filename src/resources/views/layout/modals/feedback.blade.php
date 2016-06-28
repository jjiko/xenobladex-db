<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="fbModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <div class="pre">
                    <h4 class="modal-title" id="fbModalLabel">Feedback</h4>
                </div>
                <div class="sent" hidden>
                    <h4 class="modal-title">Your message is sent! </h4>
                </div>
            </div>
            <div class="modal-body">
                <form class="form" id="feedbackForm" action="/message" method="post">
                    <input name="subject" type="hidden" value="Xenoblade X DB Feedback">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Your email (optional)</label>
                        <input name="email" type="email" class="form-control" id="sender-name" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Message</label>
                        <textarea name="message" class="form-control" id="message-text" placeholder="Type something here.."></textarea>
                    </div>
                </form>
                <div class="sent" hidden>
                    <p>Thank you.</p>
                    <p>If you left your email, I'll get back to you soon.</p>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pre">
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
                <div class="sent" hidden>
                    <button class="btn btn-default" disabled>Sent <i class="material-icons" style="vertical-align: middle">done</i>
                </div>
            </div>
        </div>
    </div>
</div>