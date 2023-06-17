export function isRequired(value) {
    if (!value || value.trim() === "") {
        return "Este campo é obrigatório!";
    }
    return true;
}

export function fileRequired(value) {
    if (!value) {
        return "Este campo é obrigatório!";
    }
    return true;
}

export function validateFullName(name) {
    let errorMessage = "";

    if (!name || name.trim() === "") {
        errorMessage = "Este campo é obrigatório!";
    } else if (!/^[a-zA-Z\u00C0-\u017F\s]+$/.test(name)) {
        errorMessage = "O nome não deve conter números ou caracteres especiais.";
    } else if (name.trim().split(" ").length < 2) {
        errorMessage = "Insira seu nome completo.";
    }

    if (errorMessage) {
        return errorMessage;
    }

    return true;
}

export function validateCPF(value) {
    if (!value) {
        return "Este campo é obrigatório!";
    }

    value = value.replace(/[^0-9]/g, "");

    if (value.length !== 11) {
        return "Este campo deve ter 11 dígitos!";
    }

    if (value === "00000000000") return "CPF inválido";

    let Soma;
    let Resto;
    Soma = 0;

    for (let i = 1; i <= 9; i++) Soma += parseInt(value.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if (Resto === 10 || Resto === 11) Resto = 0;
    if (Resto !== parseInt(value.substring(9, 10))) return "CPF inválido";

    Soma = 0;

    for (let i = 1; i <= 10; i++) Soma += parseInt(value.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if (Resto === 10 || Resto === 11) Resto = 0;
    if (Resto !== parseInt(value.substring(10, 11))) return "CPF inválido";

    return true;
}

export async function validateCEP(value) {
    if (!value) {
        return "Este campo é obrigatório!";
    }

    value = value.replace(/\D/g, "");

    const regex = /^[0-9]{8}$/;
    if (!regex.test(value)) {
        return "Este campo deve ser um CEP válido!";
    }
    const response = await fetch(`https://viacep.com.br/ws/${value}/json/`);
    const data = await response.json();
    if (data.erro) {
        return "Este CEP não existe";
    }
    return true;
}

export function onRgSelect(field, event) {
    const files = event.target.files;
    if (files.length === 1) {
        const file = files[0];
        if (file.size <= 3 * 1024 * 1024) {
            //3MB
            this.form[field] = file;
        } else {
            event.target.value = null;
            alert("O arquivo deve ter no máximo 3MB.");
        }
    } else {
        event.target.value = null;
        alert("1 Arquivo no máximo.");
    }
}