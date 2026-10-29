document.addEventListener(
    "DOMContentLoaded",
    function () {

        const password =
            document.querySelector(
                'input[name="password"]'
            );

        const confirmPassword =
            document.querySelector(
                'input[name="confirm_password"]'
            );

        if (password && confirmPassword) {

            confirmPassword.addEventListener(
                "input",
                function () {

                    if (
                        password.value !==
                        confirmPassword.value
                    ) {

                        confirmPassword.setCustomValidity(
                            "Passwords do not match."
                        );

                    } else {

                        confirmPassword.setCustomValidity("");

                    }

                }
            );

        }

    }
);