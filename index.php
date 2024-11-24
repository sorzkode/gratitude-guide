<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token']; 
?>

<!DOCTYPE html>
<html>

<head>
    <title>Guided Gratitude Letter</title>

    <script src="gratitude-form.js"></script>
    <link rel="stylesheet" href="style.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mister Riley">
    <meta name="title" content="Guided Gratitude Letter">
    <meta name="description"
        content="Think of a resume builder but for gratitude letters. The form is broken down into specific sections to make writing your letter easier. You can download the completed form as a word document for further editing if needed. This form is part of the thoughtcultivation.com project.">
    <meta name="keywords" content="gratitude, letter, thanks, thank you, friend, family, positive, impact, gratitude template, guided gratitude, thoughtcultivation.com">
    <meta name="robots" content="index, follow">
</head>


<body>
    <div class="form-container">
        <h1>📝 Guided Gratitude Letter</h1>
        <p>Use the form below to craft a gratitude letter to someone who has made a positive impact in your life. If possible, deliver this letter in person and read it to them.</p>

        <form id="gratitude-form" action="form_processing.php" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <fieldset class="theme-section">
                <legend>🎨 Theme</legend>

                <div class="form-group">
                    <label for="letterTitle">Give your letter a title</label>
                    <input type="text" id="letterTitle" name="letterTitle" maxlength="50" placeholder="🤗 THANK YOU SO MUCH" required>
                </div>

                <div class="form-group">
                    <label for="letterTheme">Select a color</label>
                    <div>
                        <input type="radio" id="theme-black" name="letterTheme" value="#000000" checked>
                        <label for="theme-black">Black <span style="color:  #000000; display: inline-block;">■</span></label>

                        <input type="radio" id="theme-blue" name="letterTheme" value="#0010c2">
                        <label for="theme-blue">Blue <span style="color:  #0010c2; display: inline-block;">■</span></label>

                        <input type="radio" id="theme-green" name="letterTheme" value="#2a792d">
                        <label for="theme-green">Green <span style="color: #2a792d; display: inline-block;">■</span></label>

                        <input type="radio" id="theme-purple" name="letterTheme" value="#660066">
                        <label for="theme-purple">Purple <span style="color: #660066; display: inline-block;">■</span></label>

                        <input type="radio" id="theme-pink" name="letterTheme" value="#ffb4c0">
                        <label for="theme-pink">Pink <span style="color: #ffb4c0; display: inline-block;">■</span></label>

                        <input type="radio" id="theme-red" name="letterTheme" value="#d30000">
                        <label for="theme-red">Red <span style="color: #d30000; display: inline-block;">■</span></label>

                        <input type="radio" id="theme-orange" name="letterTheme" value="#e19200">
                        <label for="theme-orange">Orange <span style="color: #e19200; display: inline-block;">■</span></label>

                        <input type="radio" id="theme-brown" name="letterTheme" value="#8b4a1f">
                        <label for="theme-brown">Brown <span style="color: #8b4a1f; display: inline-block;">■</span></label><br>
                        <p style="text-align: center;"><i>pssst....pick their favorite color</i></p>
                    </div>
                </div>
            </fieldset>

            <fieldset class="recipient-section">
                <legend>👤 Recipient</legend>
                <div class="form-group">
                    <label for="letterGreeting">Select a Greeting</label>
                    <select id="letterGreeting" name="letterGreeting">
                        <option value="Dear" selected>Dear</option>
                        <option value="To">To</option>
                        <option value="Hello">Hello</option>
                        <option value="Greetings">Greetings</option>
                        <option value="Hi">Hi</option>
                        <option value="Hey">Hey</option>
                        <option value="Good Day">Good Day</option>
                        <option value="Salutations">Salutations</option>
                        <option value="Howdy">Howdy</option>
                        <option value="My Dearest">My Dearest</option>
                        <option value="Yo">Yo</option>
                        <option value="My Beloved">My beloved</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="recipientName">Who are you writing?</label>
                    <input type="text" id="recipientName" name="recipientName" maxlength="50" placeholder="e.g., John, Sarah, Mom, Dad" required>
                </div>
                <div class="form-group">
                    <label for="relationshipTo">What is your relationship to this person?</label>
                    <input type="text" id="relationshipTo" name="relationshipTo" maxlength="50" placeholder="e.g., best friend, friend, coworker, mentor, sister, brother, mother, father" required>
                </div>
            </fieldset>

            <fieldset class="body-section">
                <legend>📜 Body</legend>
                <div class="form-group">
                    <label for="historyTogether">Describe when and / or how you met</label>
                    <textarea id="historyTogether" name="historyTogether" maxlength="500" placeholder="e.g, We first met during our freshman year of college, in that painfully awkward orientation icebreaker. I remember how you cracked that joke about the group activity, and suddenly everyone relaxed. We ended up in the same group and spent the rest of the day exploring campus and trying to figure out where the cafeteria was. From that first conversation, I knew you were someone I would get along with. Little did I know, we would go on to share so much of this journey together." required></textarea>
                </div>
                <div class="form-group">
                    <label for="sharedMemories">Share a favorite memory</label>
                    <textarea id="sharedMemories" name="sharedMemories" maxlength="500" placeholder="e.g. One of my favorite memories is that road trip we took to the mountains. I can still hear us singing along (badly!) to the playlist we made the night before. The hike to the summit, the stunning view, and the way we just sat in silence, appreciating the moment — it was one of those rare times when everything felt perfect. Moments like that remind me how lucky I am to have a friend who can turn a simple trip into something unforgettable." required></textarea>
                </div>
                <div class="form-group">
                    <label for="impactStatement">How has this person impacted your life?</label>
                    <textarea id="impactStatement" name="impactStatement" maxlength="500" placeholder="e.g., You have impacted my life in more ways than I can count. Your unwavering support through some of my toughest times has meant everything to me. When I doubted myself, you believed in me. When I felt stuck, you reminded me to keep going. Your advice, your honesty, and your constant encouragement have shaped the person I am today." required></textarea>
                </div>
                <div class="form-group">
                    <label for="admiredQualities">What qualities do you admire in this person?</label>
                    <textarea id="admiredQualities" name="admiredQualities" maxlength="500" placeholder="e.g., I deeply admire your sense of humor, your kindness, and your loyalty. You have this rare ability to make anyone feel comfortable, and you always go out of your way to help others. Your positivity is infectious, and your determination to chase your dreams inspires me to do the same." required></textarea>
                </div>
                <div class="form-group">
                    <label for="thanksFor">What are you grateful for?</label>
                    <textarea id="thanksFor" name="thanksFor" maxlength="500" placeholder="e.g., I am so grateful for your friendship. You have been my rock, my cheerleader, and my voice of reason. Thank you for being there in every season of my life — for the laughter, the deep talks, the adventures, and the ordinary days that felt extraordinary because of you." required></textarea>
                </div>
            </fieldset>

            <fieldset class="closing-section">
                <legend>✒️ Closing</legend>
                <div class="form-group">
                    <label for="formalClosing">Select a Closing</label>
                    <select id="formalClosing" name="formalClosing">
                        <option value="Sincerely" selected>Sincerely</option>
                        <option value="With Gratitude">With Gratitude</option>
                        <option value="Yours Truly">Yours Truly</option>
                        <option value="Best Wishes">Best Wishes</option>
                        <option value="Warm Regards">Warm Regards</option>
                        <option value="Love">Love</option>
                        <option value="Forever Yours">Forever Yours</option>
                        <option value="Fondly">Fondly</option>
                        <option value="Take Care">Take Care</option>
                        <option value="Best Regards">Best Regards</option>
                        <option value="Warmly">Warmly</option>
                        <option value="With Love">With Love</option>
                        <option value="Affectionately">Affectionately</option>
                        <option value="Forever Grateful">Forever Grateful</option>
                        <option value="With Appreciation">With Appreciation</option>
                        <option value="With Thanks">With Thanks</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="yourSignature">Your Name</label>
                    <input type="text" id="yourSignature" name="yourSignature" maxlength="50" placeholder="Jane" required>
                </div>
            </fieldset>

            <div class="button-group">
                <button type="reset" class="button-reset">🧹 Clear Form</button>
                <button id="print-letter" type="button" class="button-print">🖨️ Print Letter</button>
                <button type="submit" class="button-submit">📩 Download Letter</button>
            </div>

        </form><br>

        <fieldset class="preview-section">
            <legend>👁️ Preview</legend>
            <div class="preview-content">

            </div>
        </fieldset>
    </div>
</body>

</html>