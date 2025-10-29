$(function(){
    const publicKey = `-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtc/NZLtYG41WizaYFo34
pDG4cpemlTOgqK1LfQBtsQk55sk0URQSD05UY1X+VS1cc5xNGWHGj71Y1hViqE2O
vZC1n4i+zS+0dD4UkXkkzaBkd2S+SCbgWYpUjZYe3vn55YSPh7Jpn7zAgBrxtnkU
nb2XTSrEpvhlWXwPVSpfIsuXkX1XchS6kqzLYaGvNv6FyqIJPK0ttyvzDh9Nn2PF
1zLIivSuTDqwgvJg6crSQ5vxF2iXMIUcNM+lju+ccFLKCs1uo/1+X6/OSLrys4HH
b4wBeXjFroshd7+3TYWIm5l1PDiYghS7jTncke1Dzh9z+g6k01EvSJWTx1KigJKi
ywIDAQAB
-----END PUBLIC KEY-----`;
    const encrypt = new JSEncrypt();
    encrypt.setPublicKey(publicKey);

    // 封装加密函数
    function encryptValue(value) {
       try {
            return encrypt.encrypt(value.replace("'", "''"));
        } catch (error) {
            console.error('加密失败:', error);
            alert('加密过程中发生错误，请稍后再试。');
            throw error;
        }
    }

    function handleFormSubmit(event) {
        event.preventDefault(); // 阻止表单默认提交行为

        const username = $('#username').val().trim();
        const tmppd = $('#password').val().trim();

        if (!username || !tmppd) {
            alert('用户名和密码不能为空。');
            return;
        }

        const encryptedUsername = encryptValue(username);
        const encryptedPassword = encryptValue(tmppd);

        $('#username').attr('type', 'password').val(encryptedUsername);
        $('#password').attr('type', 'password').val(encryptedPassword);
		ajaxing({text:'登录中...'});
        // 这里可以添加提交表单的代码，或者使用 AJAX 提交
        this.submit();
    }

    // 使用 class 选择器代替 ID 选择器
    const form = document.querySelector('#form');
    if (form) {
        form.addEventListener('submit', handleFormSubmit);
    }
});