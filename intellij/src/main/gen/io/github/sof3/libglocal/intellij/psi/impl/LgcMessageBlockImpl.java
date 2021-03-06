// This is a generated file. Not intended for manual editing.
package io.github.sof3.libglocal.intellij.psi.impl;

import java.util.List;
import org.jetbrains.annotations.*;
import com.intellij.lang.ASTNode;
import com.intellij.psi.PsiElement;
import com.intellij.psi.PsiElementVisitor;
import com.intellij.psi.util.PsiTreeUtil;
import static io.github.sof3.libglocal.intellij.parser.LgcElements.*;
import com.intellij.extapi.psi.ASTWrapperPsiElement;
import io.github.sof3.libglocal.intellij.psi.*;

public class LgcMessageBlockImpl extends ASTWrapperPsiElement implements LgcMessageBlock {

  public LgcMessageBlockImpl(@NotNull ASTNode node) {
    super(node);
  }

  public void accept(@NotNull LgcVisitor visitor) {
    visitor.visitMessageBlock(this);
  }

  public void accept(@NotNull PsiElementVisitor visitor) {
    if (visitor instanceof LgcVisitor) accept((LgcVisitor)visitor);
    else super.accept(visitor);
  }

  @Override
  @NotNull
  public List<LgcArgModifier> getArgModifierList() {
    return PsiTreeUtil.getChildrenOfTypeAsList(this, LgcArgModifier.class);
  }

  @Override
  @NotNull
  public List<LgcDocModifier> getDocModifierList() {
    return PsiTreeUtil.getChildrenOfTypeAsList(this, LgcDocModifier.class);
  }

  @Override
  @NotNull
  public LgcFullLiteral getFullLiteral() {
    return findNotNullChildByClass(LgcFullLiteral.class);
  }

  @Override
  @NotNull
  public List<LgcVersionModifier> getVersionModifierList() {
    return PsiTreeUtil.getChildrenOfTypeAsList(this, LgcVersionModifier.class);
  }

  @Override
  @Nullable
  public PsiElement getEol() {
    return findChildByType(EOL);
  }

  @Override
  @NotNull
  public PsiElement getEquals() {
    return findNotNullChildByType(EQUALS);
  }

  @Override
  @Nullable
  public PsiElement getIndentDecrease() {
    return findChildByType(INDENT_DECREASE);
  }

  @Override
  @Nullable
  public PsiElement getIndentIncrease() {
    return findChildByType(INDENT_INCREASE);
  }

  @Override
  @NotNull
  public PsiElement getMessageId() {
    return findNotNullChildByType(IDENTIFIER);
  }

}
