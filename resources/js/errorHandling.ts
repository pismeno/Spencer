function ErrorHandlingMessage(id:string, text:string, classD :string = ""):HTMLDivElement{
    const errorDivMsg = document.createElement("div");
    const errorSmallText = document.createElement("small");
    errorDivMsg.id=id;
    errorDivMsg.className = `text-danger ${classD}`;
    errorSmallText.textContent=text;
    errorDivMsg.appendChild(errorSmallText);
    return errorDivMsg;
}

function ErrorHandlingForm(idInput:string, idDiv:string, text:string, classD:string =""){
    const input = document.getElementById(idInput) as HTMLInputElement;
    input?.classList.add("border", "border-danger", "text-danger");
    const errorDivMessage = ErrorHandlingMessage(idDiv, text, classD);
    input.insertAdjacentElement("afterend", errorDivMessage);
    input.addEventListener("change", () => {
        input?.classList.remove("border", "border-danger", "text-danger");
        errorDivMessage?.remove();
    })
}
export default ErrorHandlingForm;